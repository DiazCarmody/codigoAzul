<?php
	require_once('../../logica/main.php');
	$conexion=conectar();
	$listaPacientes=$conexion->query("SELECT * FROM habitaciones INNER JOIN areas ON habitaciones.id_area = areas.area_id;");
	$listaPacientes=$listaPacientes->fetchAll();

	ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>listaDeHabitaciones</title>
</head>
<body>
	<h1>Lista de habitaciónes</h1>
	
	<table border="2" style="column-gap: 5px;">
		<thead> 
			<tr><th>Habitación</th> <th>Área</th>
		</thead>
		<?php foreach ($listaPacientes as $datos){
			echo'
			<tr>'.
				'<td>'.$datos['habitacion_nombre'].'</td>'.
				'<td>'.$datos['area_nombre'].'</td>'.
			'</tr>';
		}?>
	</table>
</body>
</html>
<?php

	$html=ob_get_clean();
	//echo $html;
	require_once('../../librerias/dompdf/autoload.inc.php');
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();
	$options = $dompdf->getOptions();
	$options->set(array('isRemoteEnabled' => true));
	$dompdf->setOptions($options);
	$dompdf->loadHtml($html);
	$dompdf->setPaper('letter');
	$dompdf->setPaper('A4', 'landscape');
	$dompdf->render();
	$dompdf->stream("archivo_listaDeHabitaciones.pdf", array("attachment" => false));

?>