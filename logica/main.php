<?php
//HECHO POR FAUSTO.
//
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
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
	// $cadena=str_ireplace("AND", "", $cadena);
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
//Función para enviar emails
function enviarEmail($emailReceptor, $subject, $message){
	require_once '../librerias/PHPMailer/src/PHPMailer.php';
	require_once '../librerias/PHPMailer/src/Exception.php';
	require_once '../librerias/PHPMailer/src/SMTP.php';
	$appPassword="";
    //to es el receptor. ej= $to = $email;
    //subject es el título. ej= $subject = "Restablecer contraseña";
    //message es el contenido. ej= $message = "Para restablecer tu contraseña, copia y pega el siguiente enlace: \n\n$resetUrl";
    //$message .= "\n\nEste enlace expirará en 1 hora.";
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = 2; // Habilita la salida de depuración detallada
    // $mail->Debugoutput = 'html'; // Formatea la salida como HT
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '@gmail.com'; // Tu correo Gmail
    $mail->Password   = $appPassword; // Tu contraseña de aplicación de Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Cambiado a SMTPS (SSL)
    $mail->Port       = 465; // Puerto para SSL

    $mail->setFrom('correo', 'nombre');
    $mail->addAddress($emailReceptor);

    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8'; // Asegura que los caracteres especiales se muestren correctamente
    $mail->Subject = $subject;
    $mail->Body    = $message;

    return $mail->send();
}
//Función para enviar emails
//Función para Enviar mensajes de WSP.
function enviarMensaje($telefonoRef, $mensaje) {
    // Validar el formato del teléfono (ejemplo sencillo, puedes mejorarlo)
    if (!preg_match('/^\d+$/', $telefonoRef)) {
        error_log("Número de teléfono inválido: " . $telefonoRef);
        return false;
    }
    
	$params = array(
		'token' => 'fkd9nis2e7rrgkkm', // Poner el token directamente para probar
		'to' => "+54" . $telefonoRef,
		'body' => $mensaje 
	);
	

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => getenv('ULTRAMSG_URL') . "/messages/chat", // URL desde variable de entorno
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10, // Reducir el timeout si es adecuado
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
        ),
    ));

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        error_log("cURL Error #:" . $err);
        return false;
    }

    if ($httpCode >= 400) {
        error_log("HTTP Error #: " . $httpCode . " - Response: " . $response);
        return false; // Devolver false en caso de error HTTP
    }

    return $response; // Devolver la respuesta en cas5o de éxito
}

//Función para Enviar mensajes de WSP.
?>