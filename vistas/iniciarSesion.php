<main class="formmain">
        <form action="" method="POST" class="codigoform" >

            <h1>Iniciar sesión</h1>
                <div class="form-rest"></div>
                <label for="email_usuario">Email</label>
                <input type="email" name="email_usuario" placeholder="Email" required>

                <label for="clave_usuario">Contraseña</label>
                <input type="password" name="clave_usuario" placeholder="Contraseña" required> 

                <input type="submit" class="submit" value="INGRESAR">

        <?php
        if (isset($_POST['email_usuario']) && isset($_POST['clave_usuario'])){
            require_once('./logica/login.php');
        }
        ?>
        </form>
</main>