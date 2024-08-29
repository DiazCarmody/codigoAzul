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

$conexion=conectar();
$consulta_areas=$conexion->query("SELECT * FROM areas ORDER BY area_nombre ASC;");
$consulta_areas=$consulta_areas->fetchAll();
?> 


	<main class="formmain">
		
		<form autocomplete="off" action="./logica/crearHabitacion.php" method="POST" class="FormularioAjax codigoform">
			<h1>Habilitar Habitación</h1>
			<div class="form-rest"></div>
			<label for="habitacion_nombre">Nombre de la habitación</label>
			<input type="text" name="habitacion_nombre" placeholder="Nombre de la habitación">

			<label for="id_areas">Elija el área</label>
			<select name="id_areas" class="input">
				<?php 
					foreach ($consulta_areas as $rows_areas) {
					echo'<option value="'.$rows_areas['area_id'].'">'.$rows_areas['area_nombre'].'</option>';
					}  
				?>
			</select>
			<input type="submit" value="Habilitar">
		</form>

	</main>
