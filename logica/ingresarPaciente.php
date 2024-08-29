<?php
require_once('./main.php');

$paciente_nombre=limpiarString($_POST['nombre']);
$paciente_apellido=limpiarString($_POST['apellido']);
$paciente_edad=limpiarString($_POST['edad']);
$paciente_domicilio=limpiarString($_POST['domicilio']);
$datosmedicos=limpiarString($_POST['datosmedicos']);
$id_medico=limpiarString($_POST['opcionMedico']);
$id_habitacion=limpiarString($_POST['opcionHabitacion']);
$conectar=conectar();
// $conectar2=conectar2();
$insertar=$conectar->prepare("INSERT INTO `pacientes`(paciente_nombre, paciente_apellido, paciente_edad,paciente_domicilio, paciente_datosmedicos, id_medico, id_habitacion) VALUES (:nombre,:apellido,:edad,:domicilio,:datosmedicos,:id_medico,:id_habitacion)");
// $insertar2=$conectar2->prepare("INSERT INTO `pacientes`(paciente_nombre, paciente_apellido, paciente_edad,paciente_domicilio, paciente_datosmedicos, id_medico, id_habitacion) VALUES (:nombre,:apellido,:edad,:domicilio,:datosmedicos,:id_medico,:id_habitacion)");
$arrayDatos=[
	":nombre" => $paciente_nombre,
	":apellido" => $paciente_apellido,
	":edad" => $paciente_edad,
	":domicilio" => $paciente_domicilio,
	":datosmedicos" => $datosmedicos,
	":id_medico" => $id_medico,
	":id_habitacion" => $id_habitacion
];
// $arrayDatos2=[
// 	":nombre" => $paciente_nombre,
// 	":apellido" => $paciente_apellido,
// 	":edad" => $paciente_edad,
// 	":domicilio" => $paciente_domicilio,
// 	":datosmedicos" => $datosmedicos,
// 	":id_medico" => $id_medico,
// 	":id_habitacion" => $id_habitacion
// ];
$insertar->execute($arrayDatos);
if($insertar->rowCount()>0){
	echo'
		<div class="notification is-success">
			Emergencia ingresada correctamente.
		</div>
		';
}else{
	echo'
		<div class="notification is-danger">
			Ocurrió un error.
		</div>	
	';
}
$insertar=null;
// $insertar2->execute($arrayDatos2);
// $insertar2=null;
?>