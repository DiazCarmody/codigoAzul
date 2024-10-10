<?php
require_once('./main.php');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['mensaje']) && isset($_POST['telefono'])) {
        // Limpiar los datos de entrada
      $mensaje = ($_POST['mensaje']);
      $telefono = limpiarString($_POST['telefono']);
    }else{
      echo "ERROR";
    }
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