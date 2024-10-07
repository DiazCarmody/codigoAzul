<?php
require_once('./main.php');
$nombre=limpiarString($_POST['medico_nombre']);
$apellido=limpiarString($_POST['medico_apellido']);
$dni=limpiarString($_POST['new_email']);
$telefono=limpiarString($_POST['numero_telefono']);
$especializacion=limpiarString($_POST['medico_especializacion']);
$conexion=conectar();
// $conexion2=conectar2();
$queryMedico=$conexion->prepare("INSERT INTO `medicos`(`medico_id`, `medico_nombre`, `medico_apellido`, `medico_email`, `medico_telefono`, `medico_especializacion`) VALUES (NULL,:nombre,:apellido,:email, :telefono,:especializacion)");
	$arrayMedicos=[
	":nombre"=>$nombre,
	":apellido"=>$apellido,
	":email"=>$email,
	":telefono"=>$telefono,
	":especializacion"=>$especializacion
];
$checkUsername=$conexion->query("SELECT * FROM medicos WHERE medico_email = '$email';");
if($checkUsername->rowCount()==1){
	echo'
	<div class="button is-danger">
		El DNI ya existe.
	</div>
	';
} 
else{
	$queryMedico->execute($arrayMedicos);

	// $queryMedico=$conexion2->prepare("INSERT INTO `medicos`(`medico_id`, `medico_nombre`, `medico_apellido`, `medico_dni`, `medico_especializacion`) VALUES (NULL,:nombre,:apellido,:dni,:especializacion)");

	// $queryMedico->execute($arrayMedicos);

	echo'
	<div class="notification is-success">
		Enfermero Habilitado correctamente.
	</div>
	';
}
$queryMedico=null;
exit();
?>
