<?php
header('Content-Type: application/json');

require_once './main.php';

$conexion = conectar();

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conexion->prepare("UPDATE alertas_pendientes SET procesado = TRUE WHERE alertaPendiente_id = :id;");
    $array=[
        "id"=>$id
    ];
    $resultado = $stmt->execute($array);

    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'Alerta marcada como procesada']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al marcar la alerta como procesada']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de alerta no proporcionado']);
}