<?php

	$conexion=conectar();
	$consulta_especializacion=$conexion->query("SELECT * FROM especializaciones;");
	$consulta_especializacion=$consulta_especializacion->fetchAll();

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

	<main class="formmain">
		
		<form action="./logica/habilitarMedicoLogica.php" method="POST" class="FormularioAjax codigoform">
			<h1>Habilitar enfermero</h1>
			<div class="form-rest"></div>
			<label for="medico_nombre">Nombre del médico</label>
			<input type="text" name="medico_nombre" placeholder="Nombre del médico" required>

			<label for="medico_apellido">Apellido del médico</label>
			<input type="text" name="medico_apellido" placeholder="Apellido del médico" required>

			<label for="medico_dni">DNI</label>
			<input type="number" name="new_dni" placeholder="DNI" required>

			<label for="medico_especializacion">Elija la especialidad del médico</label>
			<select name="medico_especializacion" class="input">
				<?php 
					foreach ($consulta_especializacion as $rows_especializaciones) {
					echo'<option  value="'.$rows_especializaciones['especializacion_id'].'">'.$rows_especializaciones['especializacion_nombre'].'</option>';
					}  
				?>
			</select>

			<input class="inputhabilitar" type="submit" value="Habilitar">
		</form>
	</main>
