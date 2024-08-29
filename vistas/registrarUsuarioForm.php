<?php
	 if (isset($_SESSION['cargo'])) {
	 	$id_cargo=$_SESSION['cargo'];
	 }
	 if ($id_cargo!=1 or !isset($id_cargo)) {
	 	echo'
	 	<script>
	 	alert("Usted no está autorizado.");
	 	location.href="./index.php?vista=listaDePacientes"
	 	</script>
	 	';
	 }
?>
<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SCRIPT DARKMODE -->
		<script>

        const storageTheme = localStorage.getItem('theme');
        const systemColorScheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

        const newTheme = storageTheme ?? systemColorScheme;

        document.documentElement.setAttribute('data-theme', newTheme);

        </script>

    <script src="./scripts/darkmodeScroll.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<style>
		.material-symbols-outlined {
		font-variation-settings:
		'FILL' 0,
		'wght' 400,
		'GRAD' 0,
		'opsz' 24
		}
	</style>

    
    <link rel="stylesheet" href="./styles/formstyle.css">
    <link rel="stylesheet" href="./styles/load.css">

    <link rel="icon" href="./images/icon.png">
	<title>Alerta azul</title>
</head>
<body>


<main class="formmain">
    <form autocomplete="off" action="./logica/registrarUsuario.php" method="POST" class=" codigoform FormularioAjax">

            <h1>Registrar usuario</h1>
            <div class="form-rest"></div>
           
            <label for="usuario_nombre">Nombre</label>
                <input type="text" name="usuario_nombre" placeholder="Nombre" required>

            <label for="usuario_apellido">Apellido</label>
                <input type="text" name="usuario_apellido" placeholder="Apellido" required>

            <label for="email">Correo electrónico</label>
                <input type="email" name="email" placeholder="Correo electrónico" required> 

            <label for="usuario_clave">Contraseña</label>
                <input type="password" name="usuario_clave" placeholder="Contraseña" required> 
                
            <?php if(isset($_SESSION['cargo']) && $_SESSION['cargo']==1){
            echo '
            <label for="usuario_cargo">Cargo</label>
                <input list="rango" name ="usuario_cargo" placeholder="Rango" required>
                <datalist id="rango" name="rango-usuario" >
                    <option value="3" >Genérico</option>
                    <option value="2" >Médico</option>
                    <option value="1" >Administrador</option>
                </datalist>
                ';
            }?>
            <input type="submit" class="submit" value="REGISTRAR">

    </form>
    <br><br>
</main>
</body>
</html>