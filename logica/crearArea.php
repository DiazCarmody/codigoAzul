<?php
require_once('./main.php');
$nombreArea=limpiarString($_POST['area_nombre']);
$conexion=conectar();
// $conexion2=conectar2();
$checkArea=$conexion->query("SELECT * FROM areas WHERE area_nombre ='$nombreArea';");
if($checkArea->rowCount()==1){
	echo'
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../vistas/styles/style.css">
	</head>
		<div class="button is-danger">
		Error. Esta área ya existe.
		</div>
	';
}else{
	$registrarArea=$conexion;
	$registrarArea=$registrarArea->prepare("INSERT INTO areas values(null, :nombreArea)");

	// $registrarArea2=$conexion2;
	// $registrarArea2=$registrarArea2->prepare("INSERT INTO areas values(null, :nombreArea)");

	$arrayarea=[':nombreArea'=>$nombreArea];

	$registrarArea->execute($arrayarea);
	// $registrarArea2->execute($arrayarea);
	if ($registrarArea->rowCount()==1) {
	echo'
		<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../vistas/styles/style.css">
	</head>
		<div class="button is-success">
		¡Área registrada con éxito!
		</div>
	';		
	}

}
?>