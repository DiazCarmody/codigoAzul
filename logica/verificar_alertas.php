<?php
header('Content-Type: application/json');

require_once './main.php';

$conexion = conectar();

$query = "SELECT a.*, ap.alertaPendiente_id, hab.habitacion_nombre, hab.id_area
        FROM alertas a 
        INNER JOIN alertas_pendientes ap ON a.alerta_id = ap.alerta_id
        INNER JOIN habitaciones hab ON a.habitacion_id = hab.habitacion_id 
        WHERE ap.procesado = FALSE 
        ORDER BY a.fecha_hora DESC LIMIT 5";

$resultado = $conexion->query($query);

$alertas = [];
if ($resultado->rowCount() > 0) {
    while ($alerta = $resultado->fetch()) {
        $alertas[] = [
            'id' => $alerta['alertaPendiente_id'],
            'mensaje' => "Nueva alerta en habitación {$alerta['habitacion_nombre']}, área {$alerta['id_area']}"
        ];
    }
}

echo json_encode(['alertas' => $alertas]);