<?php
//HECHO POR FAUSTO.
// 
//función de conexión a la base de datos.
function conectar(){
	$pdo = new PDO('mysql:host=localhost;dbname=hospital','root','');
	return $pdo;
}
// function conectar2(){
// 	$pdo = new PDO('mysql:host=localhost;dbname=hospital_cds','root','');
// 	return $pdo;
//   }
//función de conexión a la base de datos.
//Función para limpiar una cadena de texto.
function limpiarString($cadena){
	$cadena=trim($cadena);
	$cadena=stripslashes($cadena);
	$cadena=str_ireplace("'", "",$cadena);
	$cadena=str_ireplace("<script>", "", $cadena);
	$cadena=str_ireplace("</script>", "", $cadena);
	$cadena=str_ireplace("<script src>", "", $cadena);
	$cadena=str_ireplace("<script type=>", "", $cadena);
	$cadena=str_ireplace("SELECT * FROM", "", $cadena);
	$cadena=str_ireplace("DELETE FROM", "", $cadena);
	$cadena=str_ireplace("DROP TABLE", "", $cadena);
	$cadena=str_ireplace("DROP DATABASE", "", $cadena);
	$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
	$cadena=str_ireplace("SELECT", "", $cadena);
	$cadena=str_ireplace("DROP", "", $cadena);
	$cadena=str_ireplace("TRUNCATE", "", $cadena);
	$cadena=str_ireplace("--", "", $cadena);
	$cadena=str_ireplace("SHOW TABLES", "", $cadena);
	$cadena=str_ireplace("SHOW DATABASES", "", $cadena);
	$cadena=str_ireplace("<?php", "", $cadena);
	$cadena=str_ireplace("?>", "", $cadena);
	$cadena=str_ireplace("--", "", $cadena);
	$cadena=str_ireplace("^", "", $cadena);
	$cadena=str_ireplace("<", "", $cadena);
	$cadena=str_ireplace("[", "", $cadena);
	$cadena=str_ireplace("]", "", $cadena);
	$cadena=str_ireplace("==", "", $cadena);
	$cadena=str_ireplace(";", "", $cadena);
	$cadena=str_ireplace("::", "", $cadena);
	$cadena=str_ireplace("AND", "", $cadena);
	// $cadena=str_ireplace("OR", "", $cadena);
	$cadena=str_ireplace("UNION", "", $cadena);
	$cadena=str_ireplace("-", "", $cadena);
	$cadena=trim($cadena);
	$cadena=stripslashes($cadena); 
	return $cadena;
}
//Función para limpiar una cadena de texto.
//Función para renombrar imágenes
function renombrarFotos($nombreFoto){
	$nombreFoto=str_ireplace(" ","_","$nombreFoto");
	$nombreFoto=str_ireplace("/","_","$nombreFoto");
	$nombreFoto=str_ireplace("#","_","$nombreFoto");
	$nombreFoto=str_ireplace("-","_","$nombreFoto");
	$nombreFoto=str_ireplace("$","_","$nombreFoto");
	$nombreFoto=str_ireplace(".","_","$nombreFoto");
	$nombreFoto=str_ireplace(",","_","$nombreFoto");
	$nombreFoto = $nombreFoto."_".rand(0,100);
	return $nombreFoto;
}
//Función para renombrar imágenes
//Función para encriptar contraseña
function encriptar($clave){
	$claveDefinitiva=password_hash($clave, PASSWORD_BCRYPT,['cost'=>10]);
	return $claveDefinitiva;
}
//Función para encriptar contraseña
//Función para generar un código de autentificación, el cual siempre es aleatorio
function generarCodigoAutentificacion(){
	$codigoAutentificacion=rand(999, 10000);
	return $codigoAutentificacion;
}
//Función para generar un código de autentificación
?>