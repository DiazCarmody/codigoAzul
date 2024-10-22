<?php
require_once('./main.php');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
      // Limpiar los datos de entrada
      //en este caso, el id de habitación es fijo para hacerlo más rápido
      $id_habitacion=25;
      $con=conectar();
      $query=$con->prepare("SELECT * FROM pacientes INNER JOIN habitaciones ON pacientes.id_habitacion = habitaciones.habitacion_id INNER JOIN medicos ON pacientes.id_medico = medicos.medico_id INNER JOIN areas ON areas.area_id=habitaciones.id_area WHERE habitacion_id = :id_habitacion;
      ");
      $arrayBuscarHab=[
        ":id_habitacion"=>$id_habitacion
      ];
      $query->execute($arrayBuscarHab);
      if($query->rowCount()>0){
        $datosPaciente=$query->fetch();
      }else{
        $datosPaciente=null;
      }
      $apellidoMedico=$datosPaciente['medico_apellido'];
      $nombreMedico=$datosPaciente['medico_nombre'];
      $nombreHabitacion=$datosPaciente['habitacion_nombre'];
      $nombreArea=$datosPaciente['area_nombre'];
      $nombrePaciente=$datosPaciente['paciente_nombre'];
      $apellidoPaciente=$datosPaciente['paciente_apellido'];
      $mensaje = "Dr. ".$nombreMedico." ".$apellidoMedico."\n";
      $mensaje .="Se solicita su presencia en Habitación : ".$nombreHabitacion.", Área : ".$nombreArea."\n";
      $mensaje .="Paciente : ".$apellidoPaciente." ".$nombrePaciente;
      $telefono =$datosPaciente['medico_telefono'];
  $params=array(
  'token' => 'fkd9nis2e7rrgkkm',
  'to' => '+54'.$telefono,
  'body' => $mensaje
  );
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.ultramsg.com/instance96184/messages/chat",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query($params),
    CURLOPT_HTTPHEADER => array(
      "content-type: application/x-www-form-urlencoded"
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }
}else{
  echo"<div class 'notification is-danger'>MÉTODO NO PERMITIDO";
}
?>