<?php
require_once('./main.php');
$nombreHabitacion=$_POST['habitacion_nombre'];
$areanueva=$_POST['id_areas']; 
$conexion=conectar();
// $conexion2=conectar2();
$check_habitacion=$conexion->query("SELECT * FROM habitaciones WHERE habitacion_nombre = '$nombreHabitacion'");
// $check_habitacion2=$conexion2->query("SELECT * FROM habitaciones WHERE habitacion_nombre = '$nombreHabitacion'");

if($check_habitacion->rowCount()>1){
	echo "ESTA HABITACIÓN YA EXISTE";
}
else{
	$consulta_asignarHabitacion=$conexion;
	$consulta_asignarHabitacion=$consulta_asignarHabitacion->prepare("INSERT INTO habitaciones(habitacion_id, habitacion_nombre, id_area) VALUES (NULL,:nombreHabitacion,:area);");

	// $consulta_asignarHabitacion2=$conexion2;
	// $consulta_asignarHabitacion2=$consulta_asignarHabitacion2->prepare("INSERT INTO habitaciones(habitacion_id, habitacion_nombre, id_area) VALUES (NULL,:nombreHabitacion,:area);");

	$arrayHabitacion=[
		":nombreHabitacion"=>$nombreHabitacion,
		"area"=>$areanueva,
	];
	$consulta_asignarHabitacion->execute($arrayHabitacion);
	// $consulta_asignarHabitacion2->execute($arrayHabitacion);
	if ($consulta_asignarHabitacion->rowCount()==1) {
		echo'
		<div class="button is-success">
		 	¡Habitación registrada con éxito!
		 </div> 
		';
	}
	else{
		echo'
		<div class="button is-danger">
		 	¡Error! La habitación no fue registrada
		 </div> 
		';
	}
	$consulta_asignarHabitacion=null;
	// $consulta_asignarHabitacion2=null;
}
$check_habitacion=null;
// $check_habitacion2=null;
?>