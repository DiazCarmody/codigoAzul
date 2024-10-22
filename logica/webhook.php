<?php
require_once('./main.php');

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Obtener el cuerpo de la solicitud
    $input = file_get_contents('php://input');
    // Decodificar el JSON recibido
    $data = json_decode($input, true);

    if ($data) {
        // Extraer los datos del mensaje
        $from = $data['from']; // El número de quien envía el mensaje
        $body = isset($data['body']) ? $data['body'] : ''; // El contenido del mensaje (si es texto)
        $media = isset($data['media']) ? $data['media'] : null; // Si el mensaje contiene archivos adjuntos

        // Guardar el mensaje de texto en la base de datos
        if ($body) {
            $con = conectar();
            $query = $con->prepare("INSERT INTO respuestas (numero, mensaje) VALUES (:froms, :body)");
            $params=[
                ':froms' => $from,
                ':body' => $body
            ];
            $query->execute($params);
        }

        // Si se recibe un archivo multimedia
        if ($media) {
            // Procesar la descarga del archivo
            $media_url = $media['url']; // URL para descargar el archivo
            $media_type = $media['mime_type']; // Tipo de archivo (imagen, video, etc.)
            
            // Guardar el archivo en tu servidor o en la base de datos
            // Aquí puedes usar file_get_contents o cURL para descargar el archivo
        }

        // Responder con éxito
        http_response_code(200);
        echo json_encode(['status' => 'success']);
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos']);
    }
} else {
    // Si el método no es POST
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
