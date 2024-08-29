<?php
	require_once('./logica/main.php');
	$conexion=conectar();
	$listaPacientes=$conexion->query("SELECT * FROM habitaciones INNER JOIN areas ON habitaciones.id_area = areas.area_id;");
	$listaPacientes=$listaPacientes->fetchAll();

?>
	<!-- MAIN -->

	<main>
		
		<section>
		
		<h1>Habitaciones</h1>
		
		<div class="sortdiv">
			Ordenar de 
		<button class="sortbutton" onclick="sortAZ()"><span class="material-symbols-outlined">unfold_more</span>A-Z</button>
		<button class="sortbutton" onclick="sortZA()"><span class="material-symbols-outlined">unfold_more</span>Z-A</button>
		</div>
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
			$stmt = $conexion->prepare("SELECT * FROM habitaciones 
										INNER JOIN areas ON habitaciones.id_area = areas.area_id 
										WHERE habitacion_nombre LIKE :busqueda");

			$stmt->execute(array(':busqueda' => $busqueda));
			$listaPacientes = $stmt->fetchAll();
			}
			else{
				$listaPacientes=$conexion->query("SELECT * FROM habitaciones INNER JOIN areas ON habitaciones.id_area = areas.area_id;");
				$listaPacientes=$listaPacientes->fetchAll();
			}
		}
			if (isset($_POST['sort_order'])) {
				$sort_order = ($_POST['sort_order'] == 'asc') ? 'ASC' : 'DESC';
				$stmt = $conexion->prepare("SELECT * FROM habitaciones 
											INNER JOIN areas ON habitaciones.id_area = areas.area_id 
											ORDER BY habitacion_nombre $sort_order");
				$stmt->execute();
				$listaPacientes = $stmt->fetchAll();
			}
		?>
		<!--BOTONES SORT, CAMBIARLE EL ESTILO.-->

			<table class="tablaDePacientes">
				
				<thead> 
					<tr>
						
					<th> 
						<span> Habitación </span>
					</th>
					<th> 
						<span> Área </span>
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
					$nombre = urlencode($datos['habitacion_nombre']);
					echo'
					<tr>'.
						'<td data-cell="Nombre"> <span>'.$datos['habitacion_nombre'].'</span> </td>'.
						'<td data-cell="Nombre"> <span>'.$datos['area_nombre'].'</span> </td>'.

						'<td data-cell="Editar">

							<form action="./index.php?vista=edit" method="POST">
								<input type="hidden" name="id" value='.$datos['habitacion_id'].'>
								<input type="hidden" name="nombre" value='.$nombre.'>
								<input type="hidden" name="page" value="listaDeHabitaciones">
								<input type="submit" class="editar" value="Editar">
							</form>
						
						</td>'.

						'<td data-cell="Borrar">

							<form action="./vistas/delete.php" method="POST" class="FormularioAjax">
								<input type="hidden" name="id" value='.$datos['habitacion_id'].'>
								<input type="hidden" name="page" value="listaDeHabitaciones">

								<input type="submit" class="borrar" value="Borrar">
							</form>
						
						</td>'.
						
					'</tr>';
				}?>
			
			</table>

		</section>

	</main>
	<script src="./vistas/scripts/sort.js"></script>

</body>
</html>