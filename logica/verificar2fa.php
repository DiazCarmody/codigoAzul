<?php
//importo archivos con funciones...
require_once('../reciclar/session.php');
require_once('./main.php');
//caracteres pedidos en el 2fa
$caracter1=$_POST['codigo1'];
$caracter2=$_POST['codigo2'];
$caracter3=$_POST['codigo3'];
$caracter4=$_POST['codigo4'];
//concateno los caracteres del 2fa, porque se ingresan uno por uno
$caracterConcat=$caracter1.$caracter2.$caracter3.$caracter4;
##nombre de usuario (VAR GLOBAL)
$usuario=$_SESSION['email_verificar'];
##Estado de sesión de usuario (VAR GLOBAL)
$_SESSION['estadoSesion']=false;
//inicio conexión a BD. hago una consulta que selecciona los datos del usuario que inició sesión y los almaceno en un array
$conexion=conectar();
$datos=$conexion->query("SELECT * FROM usuarios WHERE usuario_email = '$usuario';");
$datos=$datos->fetchAll();
//almaceno el codigo de autenticación del usuario en una variable para luego compararlo con el post
foreach ($datos as $row) {
	$autentificacionbd=$row['autentificacion'];
}
//si los datos ingresados son correctos, lo redirecciona a la lista de pacientes, si no se cierra la sesión
if ($autentificacionbd==$caracterConcat) {
	$_SESSION['estadoSesion']=true;
	$_SESSION['id']=$_SESSION['id_verificar'];
	$_SESSION['email']=$_SESSION['email_verificar'];
	$_SESSION['cargo']=$_SESSION['cargo_verificar'];
	echo '
	<script>
	alert("Acceso concedido");
	location.href="../index.php?vista=home"
	</script> 
	';
}else{
	$_SESSION['estadoSesion']=false;
	echo '
	<script>
	alert("Acceso denegado");
	location.href="../index.php?vista=cerrarSesion"
	</script> 
	';
}
$datos=null;
?>