<?php
	require_once('./logica/main.php');
	$conexion=conectar();

	$listaPacientes=$conexion->query("SELECT * FROM pacientes 
	INNER JOIN medicos ON pacientes.id_medico = medicos.medico_id 
	INNER JOIN habitaciones ON pacientes.id_habitacion = habitaciones.habitacion_id ");
	$listaPacientes=$listaPacientes->fetchAll();
?>
	<!-- MAIN -->

	<main>

		<section>
			<h1>Emergencias</h1>
		<!-- BUSCAR -->

			<form action="" method="POST" class="searchform" id="searchform">

				<input type="hidden" name="page" value="listaDePacientes">
				<input type="hidden" value="porNombre" name="busqueda">
				<input type="text" name="parametroDeBusqueda" placeholder="Ingrese datos a buscar...">

				<button type="submit" name="enviar"> <span class="material-symbols-outlined menu">search</span>  </button>

			</form>
			<?php 
				if(isset($_POST['enviar'])){
					$busqueda = $_POST['parametroDeBusqueda'];
					$busqueda = limpiarString($busqueda);
					
					$busqueda = "%$busqueda%"; // Preparando el valor para búsqueda con comodines de SQL LIKE

					// Preparar la consulta SQL con parámetros para evitar inyección SQL
					if(empty($busqueda) == false){
					$stmt = $conexion->prepare("SELECT * FROM pacientes 
												INNER JOIN medicos ON pacientes.id_medico = medicos.medico_id 
												INNER JOIN habitaciones ON pacientes.id_habitacion = habitaciones.habitacion_id 
												WHERE paciente_nombre LIKE :busqueda OR
												paciente_apellido LIKE :busqueda OR
												paciente_edad LIKE :busqueda");

					$stmt->execute(array(':busqueda' => $busqueda));
					$listaPacientes = $stmt->fetchAll();
					}
					else{
						$listaPacientes=$conexion->query("SELECT * FROM pacientes 
						INNER JOIN medicos ON pacientes.id_medico = medicos.medico_id 
						INNER JOIN habitaciones ON pacientes.id_habitacion = habitaciones.habitacion_id ");
						$listaPacientes=$listaPacientes->fetchAll();
					}
				}else{
					$listaPacientes = $conexion->query("SELECT * FROM pacientes 
					                                            INNER JOIN medicos ON pacientes.id_medico = medicos.medico_id 
					                                            INNER JOIN habitaciones ON pacientes.id_habitacion = habitaciones.habitacion_id ")
					                                       ->fetchAll();
				}
				if (isset($_POST['sort_order'])) {
				    $sort_order = ($_POST['sort_order'] == 'asc') ? 'ASC' : 'DESC';
				    $listaPacientes = $conexion->query("SELECT * FROM pacientes 
				                                        INNER JOIN medicos ON pacientes.id_medico = medicos.medico_id 
				                                        INNER JOIN habitaciones ON pacientes.id_habitacion = habitaciones.habitacion_id 
				                                        ORDER BY paciente_apellido $sort_order")
				                               ->fetchAll();
			}
			?>
		<!--BOTONES SORT, CAMBIARLE EL ESTILO.-->
		<div class="sortdiv">
			Ordenar de 
		<button class="sortbutton" onclick="sortAZ()"><span class="material-symbols-outlined">unfold_more</span> A-Z</button>
		<button class="sortbutton" onclick="sortZA()"><span class="material-symbols-outlined">unfold_more</span> Z-A</button>
		</div>
		<!-- LISTA -->
			<table class="tablaDePacientes">
				<thead> 
					<tr>
						<th> 
							<span> Nombre </span>
						</th> 
						<th> 
							<span> Apellido </span>
						</th> 
						<th> 
							<span> Edad </span>
						</th>
						<th> 
							<span> Domicilio </span>
						</th>
						<th> 
							<span> Datos médicos </span>
						</th>
						<th>
							<span> Fecha y hora </span>
						</th>
						<th> 
							<span> Médico </span>
						</th> 
						<th> 
							<span> Habitación </span>
						</th> 
						<th> 
							<span> Acciones </span>
						</th> 
						<th> 
							<span> </span>
						</th>
					</tr>
				</thead>
				<?php foreach ($listaPacientes as $datos) {
					$nombre = urlencode($datos['paciente_nombre']);
					$apellido = urlencode($datos['paciente_apellido']);
					echo'
					<tr>'.
						'<td data-cell="Nombre"> <span>'.$datos['paciente_nombre'].'</span> </td>'.
						'<td data-cell="Apellido"> <span>'.$datos['paciente_apellido'].'</span> </td>'.
						'<td data-cell="Edad"> <span>'.$datos['paciente_edad'].'</span> </td>'.
						'<td data-cell="Domicilio"> <span>'.$datos['paciente_domicilio'].'</span> </td>'.
						'<td data-cell="Datos médicos"> <span>'.$datos['paciente_datosmedicos'].'</span> </td>'.
						'<td data-cell="Fecha"> <strong> <span>'.$datos['paciente_fechaIngreso'].'</span> </strong> </td>'.
						'<td data-cell="Enfermero"> <span>'.$datos['medico_nombre'].' '.$datos['medico_apellido'].'</span> </td>'.
						'<td data-cell="Habitación"> <span>'.$datos['habitacion_nombre'].'</span> </td>'.

						'<td data-cell="Editar">

							<form action="./index.php?vista=edit" method="POST">
								<input type="hidden" name="id" value='.$datos['paciente_id'].'>
								<input type="hidden" name="nombre" value='.$nombre.'>
								<input type="hidden" name="apellido" value='.$apellido.'>
								<input type="hidden" name="edad" value='.$datos['paciente_edad'].'>
								<input type="hidden" name="domicilio" value='.$datos['paciente_domicilio'].'>
								<input type="hidden" name="datos" value='.$datos['paciente_datosmedicos'].'>
								<input type="hidden" name="page" value="listaDePacientes">
								<input type="submit" class="editar" value="Editar">
							</form>
						
						</td>'.

						'<td data-cell="Borrar">

							<form action="./vistas/delete.php" method="POST" class="FormularioAjax">
								<input type="hidden" name="id" value='.$datos['paciente_id'].'>
								<input type="hidden" name="page" value="listaDePacientes">

								<input type="submit" class="borrar" value="Borrar">
							</form>
						
						</td>'.
					'</tr>';
				}?>
			
			</table>

		</section>

	</main>
</body>
</html>