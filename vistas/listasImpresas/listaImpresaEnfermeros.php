<?php
	require_once('../../logica/main.php');
	$conexion=conectar();
	$listaPacientes=$conexion->query("SELECT * FROM enfermero 
									  INNER JOIN especializaciones ON enfermero.enfermero_especializacion = especializaciones.especializacion_id;");
	$listaPacientes=$listaPacientes->fetchAll();

	ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>listaDeEnfermeros</title>
</head>
<body>
	<h1>Lista de enfermeros</h1>
	
	<table border="2" style="column-gap: 5px;">
		<thead> 
			<tr><th>Nombre</th> <th>Apellido</th> <th>DNI</th> <th>Especialización</th>
		</thead>
		<?php foreach ($listaPacientes as $datos){
			echo'
			<tr>'.
				'<td>'.$datos['enfermero_nombre'].'</td>'.
				'<td>'.$datos['enfermero_apellido'].'</td>'.
				'<td>'.$datos['enfermero_dni'].'</td>'.
				'<td>'.$datos['especializacion_nombre'].'</td>'.
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
	$dompdf->stream("archivo_listaDeMedicos.pdf", array("attachment" => false));

?>