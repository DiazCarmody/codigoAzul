<?php
if (isset($_SESSION['cargo'])) {
	$id_cargo=$_SESSION['cargo'];
}
if ($id_cargo!=1 && $id_cargo!=2) {
	echo'
	<script>
	alert("Usted no está autorizado.");
	location.href="index.php?vista=listaDePacientes"
	</script>
	';
}

?>

<body class="pacientesbody">

<main class="formmain">
		<form action="./logica/ingresarPaciente.php" method="POST" class="codigoform pacientesform FormularioAjax">

 			<h1>Ingrese al <strong> paciente </strong> </h1>
			<div class="form-rest"></div>
			<label for="nombre">Nombre</label required>
			<input type="text" name="nombre" class="" required placeholder="Nombre">

			<label for="apellido">Apellido</label required>
			<input type="text" name="apellido" class="" required placeholder="Apellido">

			<label for="edad">Edad</label required>
			<input type="number" name="edad" class="" required placeholder="Edad">

			<label for="domicilio">Domicilio</label required>
			<input type="text" name="domicilio" class="" required placeholder="Domicilio">

			<label for="datosmedicos">Datos Médicos</label required>
			<input type="text" name="datosmedicos" class="" required placeholder="Datos médicos">
			<!-- <textarea name="datosmedicos" required class=""></textarea> -->

			
			<label for="opcionMedico">Medico a cargo</label required>
			<select name="opcionMedico" class="inputPacientes">
				<?php
					// require_once('../logica/main.php');
					$consultaDatosMedicos="SELECT * FROM medicos ORDER BY medico_nombre ASC;";
					$conexion=conectar();
					$datosMedicos=$conexion->query($consultaDatosMedicos);
					$datosMedicos=$datosMedicos->fetchAll();
					foreach ($datosMedicos as $opcionMedicos) {
						echo '<option value="'.$opcionMedicos['medico_id'].'">'.$opcionMedicos['medico_nombre'].' '.$opcionMedicos['medico_apellido'].'</option>';
					} 
				?>
			</select>

			<label for="opcionHabitacion">Habitación</label required>
			<select name="opcionHabitacion" class="inputPacientes">
					<?php
					$consultaDatosHabitacion="SELECT * FROM habitaciones ORDER BY habitacion_nombre ASC;";
					$datosHabitaciones=$conexion->query($consultaDatosHabitacion);
					$datosHabitaciones=$datosHabitaciones->fetchAll();
					foreach ($datosHabitaciones as $opcionHabitaciones) {
						echo '<option name="opcionHabitacion" value="'.$opcionHabitaciones['habitacion_id'].'">'.$opcionHabitaciones['habitacion_nombre'].'</option>';
				} 
				?>
			</select>

			<input type="submit" value="Registrar" class="inputcrear">
			
		
		</form>
</main>

</body>