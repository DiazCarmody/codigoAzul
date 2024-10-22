<?php
require_once("./main.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"):
    if (isset($_POST['mensaje']) && isset($_POST['telefono'])) {
        // Limpiar los datos de entrada
        $mensaje = limpiarString($_POST['mensaje']);
        $telefono = limpiarString($_POST['telefono']);

        // Enviar el mensaje y verificar el resultado
        $resultado = enviarMensaje($telefono, $mensaje);
        if ($resultado) {
            echo '<div class="notification is-success">Mensaje enviado con éxito</div>';
        } else {
            echo '<div class="notification is-danger">Error al enviar el mensaje</div>';
        }
    } else {
        echo '<div class="notification is-danger">Algo salió mal</div>';
    }
endif;
?>