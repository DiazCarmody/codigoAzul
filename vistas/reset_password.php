<?php
require_once('./logica/main.php');
$con=conectar();
if($_SERVER['REQUEST_METHOD']=="POST"){ 
    $token= limpiarString(isset($_GET['token'])) ? limpiarString($_GET['token']):'';

    $contrasena1=$_POST['password_cambio'] ?? '';
    $contrasena2=$_POST['password_confirma'] ?? '';
    if (empty($token)){
        echo '
        <div class="notification is-danger>
        TOKEN NO VÁLIDO O EXPIRADO
        </div>
        ';
    }
    else if($contrasena1!=$contrasena2){
        echo'
        <div class="notification is-danger">
        LAS CONTRASEÑAS NO COINCIDEN.
        </div>
        ';
    }else{
        $password_new=encriptar($contrasena2);
        $verificarToken=$con->query("SELECT * FROM tokens WHERE token = '$token';");
        if($verificarToken->rowCount()>0){
            $verificarToken=$verificarToken->fetch();
            $user_id=$verificarToken['usuario_id'];
            $datosUsuario=$con->query("SELECT * FROM usuarios WHERE usuario_id = '$user_id';");
            if($datosUsuario->rowCount()>0){
                $cambiarPassword=$con->prepare("UPDATE usuarios SET usuario_clave = :password_new WHERE usuario_id = :user_id");
                $arrayClave=[
                    ":password_new"=>$password_new,
                    ":user_id"=>$user_id
                ];
                $cambiarPassword->execute($arrayClave);
                if($cambiarPassword->rowCount()>0){
                    $borrarToken=$con->prepare("DELETE FROM tokens WHERE token = :token;");
                    $borrarToken->execute([":token"=>$token]);
                    echo'
                    <div class="notification is-success">¡Cambio realizado con éxito!</div>
                    ';
                }else{
                    echo'
                    <div class="notification is-warning">No se ha podido realizar el cambio D:</div>
                    ';
                }
    
            }
        }else{
            echo'<div class="notification is-danger"> EL TOKEN NO EXISTE</div>';
        }
    }
}
?>
<main class="formmain">
    <form method="POST" action="" class="codigoform">
        <h2>Introduzca una nueva contraseña</h2>
        <!-- <div class="form-rest"></div> -->
        <?php if (isset($mensaje)){echo $mensaje;}?>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <label for="new_password">Nueva contraseña:</label>
        <input type="password" id="new_password" name="password_cambio" required>
        <label for="confirm_password">Confirmar nueva contraseña:</label>
        <input type="password" id="confirm_password" name="password_confirma" required>
        <input type="submit" value="Cambiar contraseña">
    </form>
</main>