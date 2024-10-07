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
$conexion=null;
$con2=conectar();
$seleccionarMedico=$con2->prepare("SELECT medico_telefono, medico_nombre, medico_apellido FROM pacientes INNER JOIN habitaciones ON pacientes.id_habitacion = habitaciones.habitacion_id INNER JOIN medicos ON pacientes.id_medico = medicos.medico_id WHERE habitacion_id = :habitacion;");
$arrayHabitacion=[
    ":habitacion"=>$resultado['habitacion_id']
];
$seleccionarMedico->execute($arrayHabitacion);
$seleccionarMedico=$seleccionarMedico->fetch();
if($seleccionarMedico['medico_numero']!=NULL){
    $numeroMedico=$seleccionarMedico['medico_numero'];
    $mensaje="Dr. {$seleccionarMedico['medico_apellido']} {$seleccionarMedico['medico_nombre']} <br>";
    $mensaje.="Nueva alerta en habitación {$alerta['habitacion_nombre']}, área {$alerta['id_area']}";
    enviarMensaje($numeroMedico, $mensaje);
}else{
    echo "ESTE MÉDICO NO TIENE NÚMERO DE TELÉFONO";
}
$alertas = [];
if ($resultado->rowCount() > 0) {
    while ($alerta = $resultado->fetch()) {
        $alertas[] = [
            'id' => $alerta['alertaPendiente_id'],
            'mensaje' => $mensaje
        ];
    }
}

echo json_encode(['alertas' => $alertas]);
