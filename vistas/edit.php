<?php
if (isset($_SESSION['cargo'])) {
	$id_cargo=$_SESSION['cargo'];
}
if ($id_cargo!=1 or !isset($id_cargo)) {
	echo'
	<script>
	alert("Usted no está autorizado.");
	location.href="../index.php?vista=listaDePacientes"
	</script>
	';
}
	require_once('./logica/main.php');
    $conexion=conectar();			 
	$ide = $_POST['id'];
	$page = $_POST['page']; 

?>


	<!-- LISTA DE PACIENTES -->

	<?php 
		if($page == "listaDePacientes") { 

			$nombre = urldecode($_POST['nombre']);
			$apellido = urldecode($_POST['apellido']);
			$edad = $_POST['edad'];
			$domicilio = $_POST['domicilio'];
			$datos = $_POST['datos']; ?>

			<body class="pacientesbody">
			<main class="formmain">

			<form action="./vistas/update.php" method="POST" class="codigoform pacientesform FormularioAjax">

				<input type="hidden" value='<?php echo $ide?>' name="id">
				<input type="hidden" value='<?php echo $page?>' name="page">

				<h1>Editar emergencia de <?php echo $nombre?> <?php echo $apellido?></h1>
				<div class="form-rest"></div>
				<label for="nombre">Nombre</label required>
				<input type="text" name="new_nombre" class="" required placeholder="Nombre" value='<?php echo $nombre ?>'>

				<label for="apellido">Apellido</label required>
				<input type="text" name="new_apellido" class="" required placeholder="Apellido" value='<?php echo $apellido ?>'>

				<label for="edad">Edad</label required>
				<input type="number" name="new_edad" class="" required placeholder="Edad" value=<?php echo $edad ?>>

				<label for="domicilio">Domicilio</label required>
				<input type="text" name="new_domicilio" class="" required placeholder="Domicilio" value=<?php echo $domicilio ?>>

				<label for="datosmedicos">Datos Médicos</label required>
				<input type="text" name="new_datos" class="" required placeholder="Datos médicos" value=<?php echo $datos ?>>
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
							echo '<option value="'.$opcionMedicos['medico_id'].'">
							'.$opcionMedicos['medico_nombre'].' '.$opcionMedicos['medico_apellido'].
							'</option>';
						} 
					?>
				</select>

				<label for="opcionHabitacion">Habitacion</label required>
				<select name="opcionHabitacion" class="inputPacientes">
						<?php
						$consultaDatosHabitacion="SELECT * FROM habitaciones ORDER BY habitacion_nombre ASC;";
						$datosHabitaciones=$conexion->query($consultaDatosHabitacion);
						$datosHabitaciones=$datosHabitaciones->fetchAll();
						foreach ($datosHabitaciones as $opcionHabitaciones) {
							echo '<option name="opcionHabitacion" required value="'.$opcionHabitaciones['habitacion_id'].'">'.$opcionHabitaciones['habitacion_nombre'].'</option>';
					} 
					?>
				</select>

				<input type="submit" value="Actualizar" name="submit" class="inputcrear">
			
			</form>
			</main>
			</body>
	<?php } ?>

	<!-- LISTA DE HABITACIONES -->

	<?php 
		if($page == "listaDeHabitaciones") { 

			$nombre = urldecode($_POST['nombre']);?>

			<main class="formmain">
			<form autocomplete="off" action="./vistas/update.php" method="POST" class="FormularioAjax codigoform">

			<input type="hidden" value='<?php echo $ide?>' name="id">
			<input type="hidden" value='<?php echo $page?>' name="page">

			<h1>Editar Habitación <?php echo $nombre?> </h1>
			<div class="form-rest"></div>
			<label for="habitacion_nombre">Nombre de la habitación</label>
			<input type="text" name="new_nombre" placeholder="Nombre de la habitación" value= '<?php echo $nombre?>' required>

			<label for="id_areas">Elija el área</label>
			<select name="id_areas" class="input" required>
				<?php 
					$consultaAreas="SELECT * FROM areas ORDER BY area_nombre ASC;";
					$datosAreas=$conexion->query($consultaAreas);
					$datosAreas=$datosAreas->fetchAll();
					foreach ($datosAreas as $opcionAreas) {
						echo '<option name="opcionHabitacion" required value="'.$opcionAreas['area_id'].'">'.$opcionAreas['area_nombre'].'</option>';
					} 
				?>
			</select>
			<input type="submit" value="Actualizar">
		</form>
		</main>
	<?php } ?>

	<!-- LISTA DE ENFERMEROS -->

	<?php 
		if($page == "listaDeMedicos") { 

			$consulta_especializacion=$conexion->query("SELECT * FROM especializaciones;");
			$consulta_especializacion=$consulta_especializacion->fetchAll();

			$nombre = urldecode($_POST['nombre']);
			$apellido= urldecode($_POST['apellido']); 
			$email = $_POST['email'];
			$tel = $_POST['telefono']?>
		<main class="formmain">
		<form action="./vistas/update.php" method="POST" class="FormularioAjax codigoform">

			<input type="hidden" value='<?php echo $ide?>' name="id">
			<input type="hidden" value='<?php echo $page?>' name="page">

			<h1>Actualizar médico <?php echo $nombre?> <?php echo $apellido?></h1>
			<div class="form-rest"></div>
			<label for="enfermero_nombre">Nombre</label>
			<input type="text" name="new_nombre" placeholder="Nombre del médico" value= '<?php echo $nombre?>' required>

			<label for="enfermero_apellido">Apellido</label>
			<input type="text" name="new_apellido" placeholder="Apellido del médico" value = '<?php echo $apellido?>' required>

			<label for="enfermero_email">Email</label>
			<input type="email" name="new_email" placeholder="Email" value = '<?php echo $email?>' required>

			<label for="enfermero_telefono">Telefono</label>
			<input type="number" name="new_telefono" placeholder="Telefono" value = '<?php echo $tel?>' required>

			
			<label for="medico_rol">Elija la especialidad del médico</label>
				<select name="medico_especializacion" class="input">
					<?php 
						foreach ($consulta_especializacion as $rows_especializaciones) {
						echo'<option  value="'.$rows_especializaciones['especializacion_id'].'">'.$rows_especializaciones['especializacion_nombre'].'</option>';
						}  
					?>
				</select>

			<input class="inputhabilitar" type="submit" value="Actualizar">
		</form>
		</main>
	<?php } ?>

	<!-- LISTA DE CUENTAS -->
		<?php 
			if($page == "listaDeCuentas") { 

				$nombre = urldecode($_POST['nombre']);
				$apellido = urldecode($_POST['apellido']);
				$email = urldecode($_POST['email']);
				$clave = $_POST['clave'];?>

				<main class="formmain">
				<form autocomplete="off" action="./vistas/update.php" method="POST" class=" codigoform FormularioAjax">

				<input type="hidden" value='<?php echo $ide?>' name="id">
				<input type="hidden" value='<?php echo $page?>' name="page">

				<h1>Actualizar usuario <?php echo $nombre?> <?php echo $apellido?></h1>
				<div class="form-rest"></div>

				<label for="usuario_nombre">Nombre</label>
					<input type="text" name="new_nombre" placeholder="Nombre" value='<?php echo $nombre ?>' required>

				<label for="usuario_apellido">Apellido</label>
					<input type="text" name="new_apellido" placeholder="Apellido" value='<?php echo $apellido ?>' required>

				<label for="email">Correo electrónico</label>
					<input type="text" name="new_email" placeholder="Correo electrónico" value='<?php echo $email ?>' required> 

				<label for="usuario_clave">Contraseña</label>
					<input type="password" name="new_clave" placeholder="Contraseña" value=<?php echo $clave ?> required> 
					
				<?php if(isset($_SESSION['cargo']) && $_SESSION['cargo']==1){
				echo '
				<label for="usuario_cargo">Cargo</label>
					<input list=”rango” name ="new_cargo" placeholder="Rango" required>
					<datalist id=”rango” name=”rango-usuario” >
						<option value="3" >Genérico</option>
						<option value="2" >Médico</option>
						<option value="1" >Administrador</option>
					</datalist>
					';
				}?>
				<input type="submit" class="submit" value="Actualizar">

				</form>
			</main>
		<?php } ?>
	<!-- LISTA DE AREAS -->

	<?php 
		if($page == "listaDeAreas") { 

			$nombre = urldecode($_POST['nombre']);?>

		<main class="formmain">
		<form action="./vistas/update.php" method="POST" class="FormularioAjax codigoform">
			
			<input type="hidden" value='<?php echo $ide?>' name="id">
			<input type="hidden" value='<?php echo $page?>' name="page">

			<h1>Actualizar <?php echo $nombre?></h1>
			<div class="form-rest"></div>
			<label for="area_nombre">Nombre de área</label>
			<input class="input" type="text" name="new_nombre" placeholder="Nombre del área" value= '<?php echo $nombre ?> 'required>

			<input type="submit" value="Actualizar" class="inputcrear">
		</form>
		</main>
	<?php } ?>

	
</main>
</body>