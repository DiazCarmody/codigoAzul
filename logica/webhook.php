<?php
require_once('./main.php');
$con = conectar();
$data = file_get_contents("php://input");
$event = json_decode($data, true);
if(isset($event)){
    //Here, you now have event and can process them how you like e.g Add to the database or generate a response
    $file = 'log.txt';  
    $data =json_encode($event)."\n";  
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);}
    // Lee el contenido del archivo
$file = 'log.txt';
if (file_exists($file)) {
    // Leer el contenido del archivo
    $fileContents = file_get_contents($file);
    
    // Divide el contenido en líneas
    $lines = explode("\n", trim($fileContents)); // Usa trim para eliminar saltos de línea extra
    
    foreach ($lines as $line) {
        // Evita líneas vacías
        if (!empty(trim($line))) {
            // Decodifica el JSON
            $event = json_decode($line, true);
            
            // Verifica si la decodificación fue exitosa
            if (json_last_error() === JSON_ERROR_NONE) {
                // Imprime el evento decodificado para depuración

                // Extraer datos del evento
                $from = $event['data']['from'] ?? null; // Campo 'from' dentro de 'data'
                $body = $event['data']['body'] ?? ''; // Campo 'body' dentro de 'data'
                $from = str_replace('@c.us', '', $from); // Elimina el sufijo

                // Verifica los valores extraídos
                if (is_null($from)) {
                    echo "El campo 'from' está ausente.\n";
                }
                if (empty($body)) {
                    echo "El campo 'body' está ausente o vacío.\n";
                }

                // Validar que los datos existen
                if ($from && !empty($body)) {
                    // Verificar si el número existe en la tabla contactos
                    $query = $con->prepare("SELECT COUNT(*) FROM medicos WHERE medico_telefono = :numero");
                    $query->execute([':numero' => $from]);
                    $exists = $query->fetchColumn();

                    if ($exists) {
                        // Prepara la consulta para insertar en la base de datos
                        $query = $con->prepare("INSERT INTO respuestas (numero, mensaje) VALUES (:froms, :body)");
                        $params = [
                            ':froms' => $from,
                            ':body' => $body
                        ];
                        
                        // Ejecuta la consulta
                        if ($query->execute($params)) {
                            file_put_contents($file, ''); // Borra el contenido del archivo
                        } else {
                            echo "Error al insertar datos: " . implode(", ", $query->errorInfo()) . "\n";
                        }
                    } else {
                        echo "El número {$from} no existe en la tabla contactos. No se insertará.\n";
                    }
                } else {
                    echo "Datos faltantes en el evento.\n";
                }
            } else {
                echo "Error al decodificar JSON: " . json_last_error_msg() . "\n";
            }
        }
    }
} else {
    echo "El archivo no existe.\n";
}
?>
