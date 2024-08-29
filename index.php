<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ('./reciclar/session.php'); 
require_once ('./logica/main.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
    .material-symbols-outlined {
    	font-variation-settings:
    	'FILL' 0,
    	'wght' 400,
    	'GRAD' 0,
    	'opsz' 24
    }
    </style>
	<link rel="stylesheet" href="./vistas/styles/bulma.css">
	<link rel="stylesheet" href="./vistas/styles/formstyle.css">
	<link rel="stylesheet" href="./vistas/styles/style.css">
	<link rel="stylesheet" href="./vistas/styles/load.css">
    <link rel="icon" href="./vistas/images/icon.png">
	<title>Código azul</title>
</head>
<body id="body">
	<div id="contenedor_carga">
		<div id="carga">
		</div>
		<div id="load-icon">
			<div id="text">
        		<h3>Cargando...</h3>
        	</div>
		</div>
	</div>
	<?php include("./reciclar/script_darknload.php"); ?>
	<?php
    $vista = limpiarString(isset($_GET['vista'])) ? limpiarString($_GET['vista']) : 'iniciarSesion';

    switch ($vista) {
        case 'recuperar_password':
            include("./reciclar/navSessionOff.php");
            include("./vistas/recuperar_password.php");
            break;
        case 'iniciarSesion':
            include("./reciclar/navSessionOff.php");
            include("./vistas/iniciarSesion.php");
            break;
        case 'reset_password':
            // include("./reciclar/navSessionOff.php");
            include("./vistas/reset_password.php");
            break;
        case '2faForm':
            include("./reciclar/navSessionOff.php");
            include("./vistas/2faForm.php");
            break;
        case 'genCodigo':
            include("./reciclar/navSessionOff.php");
            include("./vistas/genCodigo.php");            
            // if (isset($_SESSION['email'])) {
            //     include("./vistas/$vista.php");
            // } else {
            //     include("./vistas/cerrarSesion.php");
            // }
            break;
        default:
            if (is_file("./vistas/$vista.php")) {
                if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
                    if (isset($_SESSION['estadoSesion']) && $_SESSION['estadoSesion'] == true) {
                        include("./reciclar/navbar.php");
                        include("./vistas/$vista.php");
                        include("./reciclar/script.php");
                    } else {
                        include("./reciclar/navSessionOff.php");
                        include("./vistas/$vista.php");
                        include("./reciclar/script.php");
                    }
                } else {
                    include("./vistas/cerrarSesion.php");
                }
            } else {
                include("./vistas/404.php");
            }
            break;
    }
	?>
<div id="customAlert" class="custom-alert">
    <div class="alert-content">
    <span class="material-symbols-outlined">warning</span>
        <p id="alertMessage"></p>
        <div class="alert-buttons">
            <button id="confirmBtn">Confirmar</button>
            <button id="cancelBtn">Cancelar</button>
        </div>
    </div>
</div>

<script src="./logica/ajax.js"></script>
<script src="./vistas/scripts/script2fa.js"></script>
<script src="./vistas/scripts/sort.js"></script>
<?php
if (isset($_SESSION['cargo']) && $_SESSION['cargo']==1 || isset($_SESSION['cargo']) && $_SESSION['cargo']==2) {
    echo '<script src="./logica/alerta-global.js"></script>';
}
?>
</body>
</html>