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

<body>
	
	<main class="formmain">

		<form action="./logica/crearArea.php" method="POST" class="FormularioAjax codigoform">

			<h1>Crear area</h1>
			<div class="form-rest"></div>
			<label for="area_nombre">Nombre de área</label>
			<input class="input" type="text" name="area_nombre" placeholder="Nombre del área" required>

			<input type="submit" value="Crear" class="inputcrear">
		</form>
	</main>

</body>