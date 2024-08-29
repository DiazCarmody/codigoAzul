<?php
	require_once('./logica/main.php');
	$conexion=conectar();
	$listaPacientes=$conexion->query("SELECT * FROM medicos 
									  INNER JOIN especializaciones ON medicos.medico_especializacion = especializaciones.especializacion_id;");
	$listaPacientes=$listaPacientes->fetchAll();


?>
	<!-- MAIN -->

	<main>

		<section>
			<h1>Médicos</h1>
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
						$stmt = $conexion->prepare("SELECT * FROM medicos
													INNER JOIN especializaciones ON medicos.medico_especializacion = especializaciones.especializacion_id
													WHERE medico_nombre LIKE :busqueda OR
													medico_apellido LIKE :busqueda OR
													medico_dni LIKE :busqueda");

						$stmt->execute(array(':busqueda' => $busqueda));
						$listaPacientes = $stmt->fetchAll();
						}
						else{
							$conexion=conectar();
							$listaPacientes=$conexion->query("SELECT * FROM medicos 
															  INNER JOIN especializaciones ON medico.medico_especializacion = especializaciones.especializacion_id;");
							$listaPacientes=$listaPacientes->fetchAll();
						}
					}else{
						$conexion=conectar();
						$listaPacientes=$conexion->query("SELECT * FROM medicos 
														  INNER JOIN especializaciones ON medicos.medico_especializacion =especializaciones.especializacion_id");
						$listaPacientes=$listaPacientes->fetchAll();						
					}
					if (isset($_POST['sort_order'])) {
						$sort_order = ($_POST['sort_order'] == 'asc') ? 'ASC' : 'DESC';
						$stmt = $conexion->prepare("SELECT * FROM medicos 
													INNER JOIN especializaciones ON medicos.medico_especializacion = especializaciones.especializacion_id 
													ORDER BY medico_apellido $sort_order");
						$stmt->execute();
						$listaPacientes = $stmt->fetchAll();
					}
					?>
		<!--BOTONES SORT, CAMBIARLE EL ESTILO.-->
		<div class="sortdiv">
			Ordenar de 
		<button class="sortbutton" onclick="sortAZ()"><span class="material-symbols-outlined">unfold_more</span>A-Z</button>
		<button class="sortbutton" onclick="sortZA()"><span class="material-symbols-outlined">unfold_more</span>Z-A</button>
		</div>

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
						<span> DNI </span>
					</th>
					<th> 
						<span> Especialización </span>
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
					$nombre = urlencode($datos['medico_nombre']);
					$apellido = urlencode($datos['medico_apellido']);
					echo'
					<tr>'.
						'<td data-cell="Nombre"> <span>'.$datos['medico_nombre'].'</span> </td>'.
						'<td data-cell="Apellido"> <span>'.$datos['medico_apellido'].'</span> </td>'.
						'<td data-cell="Apellido"> <span>'.$datos['medico_dni'].'</span> </td>'.
						'<td data-cell="Apellido"> <span>'.$datos['especializacion_nombre'].'</span> </td>'.

						'<td data-cell="Editar">

							<form action="./index.php?vista=edit" method="POST">
								<input type="hidden" name="id" value='.$datos['medico_id'].'>
								<input type="hidden" name="nombre" value='.$nombre.'>
								<input type="hidden" name="apellido" value='.$apellido.'>
								<input type="hidden" name="dni" value='.$datos['medico_dni'].'>
								<input type="hidden" name="especializacion" value='.$datos['medico_especializacion'].'>
								<input type="hidden" name="page" value="listaDeMedicos">
								<input type="submit" class="editar" value="Editar">
							</form>
						
						</td>'.

						'<td data-cell="Borrar">

							<form action="./vistas/delete.php" method="POST" class="FormularioAjax">
								<input type="hidden" name="id" value='.$datos['medico_id'].'>
								<input type="hidden" name="page" value="listaDeMedicos">

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