<?php
	require_once('../../logica/main.php');
	$conexion=conectar();
	$listaPacientes=$conexion->query("SELECT * FROM pacientes INNER JOIN medicos ON pacientes.id_medico = medicos.medico_id INNER JOIN habitaciones ON pacientes.id_habitacion = habitaciones.habitacion_id;");
	$listaPacientes=$listaPacientes->fetchAll();

	ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>lista de pacientes</title>
</head>
<body>
	<h1>Lista de pacientes</h1>
	
	<table border="2" style="column-gap: 5px;">
		<thead> 
			<tr><th>Nombre</th> <th>Apellido</th> <th>Edad</th><th>Domicilio</th><th>Datos médicos</th>
				<th>Fecha y hora</th><th>Médico a cargo</th> <th>Habitación</th></tr>
		</thead>
		<?php foreach ($listaPacientes as $datos){
			echo'
			<tr>'.
				'<td>'.$datos['paciente_nombre'].'</td>'.
				'<td>'.$datos['paciente_apellido'].'</td>'.
				'<td>'.$datos['paciente_edad'].'</td>'.
				'<td>'.$datos['paciente_domicilio'].'</td>'.
				'<td>'.$datos['paciente_datosmedicos'].'</td>'.
				'<td>'.$datos['paciente_fechaIngreso'].'</td>'.
				'<td>'.$datos['medico_nombre'].' '.$datos['medico_apellido'].'</td>'.
				'<td>'.$datos['habitacion_nombre'].'</td>'.
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
	$dompdf->stream("archivo_listaDePacientes.pdf", array("attachment" => false));

?>