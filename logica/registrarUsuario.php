<?php
require_once('../reciclar/session.php');
require_once('./main.php');
$email=limpiarString($_POST['email']);
$nombre=limpiarString($_POST['usuario_nombre']);
$apellido=limpiarString($_POST['usuario_apellido']);
$clave=limpiarString($_POST['usuario_clave']);
$codigoAutentificacion=0;
if(!isset($_SESSION['cargo'])){
	$cargo=3;
	}else{
		$cargo=limpiarString($_POST['usuario_cargo']);
	} 
//encripto 
$clave=encriptar($clave);
//consulta
$conectar=conectar();
// $conectar2=conectar2();
$checkEmail=$conectar->query("SELECT * FROM usuarios WHERE usuario_email = '$email';");
if($checkEmail->rowCount()==1){
    echo'
    <div class="button is-danger">
        Este email ya existe. Utilice otro email.
    </div>
    ';
}else{
    $queryInsertar=$conectar->prepare("INSERT INTO usuarios(usuario_id, usuario_nombre, usuario_apellido, usuario_email, usuario_clave, autentificacion, id_cargo) VALUES (NULL,:nombre,:apellido,:email,:clave,:autentificacion,:cargo)");
    // $queryInsertar2=$conectar2->prepare("INSERT INTO usuarios(usuario_id, usuario_nombre, usuario_apellido, usuario_email, usuario_clave, autentificacion, id_cargo) VALUES (NULL,:nombre,:apellido,:email,:clave,:autentificacion,:cargo, NULL)");
    $arrayClaves=[
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":email"=>$email,
        ":clave"=>$clave,
        ":cargo"=>$cargo,
        ":autentificacion"=>$codigoAutentificacion
    	];
		$queryInsertar->execute($arrayClaves);
		// $queryInsertar2->execute($arrayClaves);
		if ($queryInsertar->rowCount()==1) {
			echo '
			<div class="notification is-success">
				¡Usuario registrado con exito!
			</div>
			';
		}else{
			echo '
			<div class="notification is-danger">
				ERROR
			</div>
			';
		}
		$queryInsertar=null;
		// $queryInsertar2=null;
	}


?>