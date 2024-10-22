<?php
require_once('./main.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtener el habitacion_id desde el POST o GET
    $habitacion_id = isset($_REQUEST['habitacion_id']) ? intval($_REQUEST['habitacion_id']) : null;
    $con = conectar();
    if ($habitacion_id !== null) {
        // Insertar la alerta en la base de datos
        $insertarAlerta = $con->prepare("INSERT INTO alertas(alerta_id, habitacion_id, fecha_hora) VALUES (NULL, :habitacion_id, current_timestamp());");
        $arrayAlerta = [":habitacion_id" => $habitacion_id];
        $insertarAlerta->execute($arrayAlerta);
        $con=null;
        if ($insertarAlerta->rowCount() > 0) {
            echo "Alarma registrada exitosamente.";
        } else {
            echo "Error al registrar la alarma.";
        }
    
    } else {
        echo "Habitación ID no válido.";
    }
} else {
    echo "Método no soportado.";
}
?>
