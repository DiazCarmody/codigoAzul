<?php
require_once('./logica/main.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './librerias/PHPMailer/src/Exception.php';
require './librerias/PHPMailer/src/PHPMailer.php';
require './librerias/PHPMailer/src/SMTP.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
        //var de conexión
        $conexion=conectar();
        //traigo el email
        $email=limpiarString($_POST['email_usuario_recover']);
        //verifico si existe en la bd
        $verificar=$conexion->query("SELECT * FROM usuarios WHERE usuario_email='$email'");
        $appPassword="qrdpgevysgenhxdb";
        if($verificar->rowCount()>0){
                //genero el token
                $token = bin2hex(random_bytes(32));
                //acá van las url
                $baseUrl = "http://localhost/codigoazul";
                $resetUrl = "$baseUrl/index.php?vista=reset_password&token=$token";
                //traigo el id 
                $verificar=$verificar->fetch();
                $user_id=$verificar['usuario_id'];
                //fecha en la cual expira el token
                $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));
                //consulta para insertar token
                $insertarToken=$conexion->prepare("INSERT INTO tokens(token_id, usuario_id, token, expira) VALUES(NULL, :user_id, :token, :expira)");
                $arrayToken=[
                        ":user_id"=>$user_id,
                        ":token"=>$token,
                        ":expira"=>$expira
                ];
                $insertarToken->execute($arrayToken);
                $to = $email;
                $subject = "Restablecer contraseña";
                $message = "Para restablecer tu contraseña, copia y pega el siguiente enlace: \n\n$resetUrl";
                $message .= "\n\nEste enlace expirará en 1 hora.";

                $mail = new PHPMailer(true);
                // $mail->SMTPDebug = 2; // Habilita la salida de depuración detallada
                // $mail->Debugoutput = 'html'; // Formatea la salida como HTML

                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'alertaazultecnica2@gmail.com'; // Tu correo Gmail
                    $mail->Password   = $appPassword; // Tu contraseña de aplicación de Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Cambiado a SMTPS (SSL)
                    $mail->Port       = 465; // Puerto para SSL
                
                    $mail->setFrom('alertaazultecnica2@gmail.com', 'Código Azul');
                    $mail->addAddress($to);
                
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8'; // Asegura que los caracteres especiales se muestren correctamente
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
                
                    $mail->send();
                    $mensaje = '<div class="notification is-success"><p>Se ha enviado un correo con instrucciones para restablecer tu contraseña. Revisa la sección de spam.</p></div>';
                } catch (Exception $e) {
                    $mensaje = '<div class="notification is-danger"><p>Hubo un error al enviar el correo. Por favor, inténtalo de nuevo. Error: </p></div>' . $mail->ErrorInfo;
                }
        } else {
                $mensaje = '<div class="notification is-danger"><p>No se encontró ninguna cuenta asociada a ese correo electrónico</p></div>';
        }
}
?>
<main class="formmain">
        <form action="" method="POST" class="codigoform " >
            <h1>Recuperar contraseña</h1>
                <?php if (isset($mensaje)){echo $mensaje;}?>
                <!-- <div class="form-rest"></div> -->
                <label for="email_usuario">Correo Electrónico</label>
                <input type="email" name="email_usuario_recover" placeholder="Email" required>
                <input type="submit" class="submit" value="INGRESAR">
        </form>
</main>