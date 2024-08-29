<?php
require_once('./main.php');
$con=conectar();
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    //dato de la llamada
    $habitacion_id=$_POST['habitacion_id'] ? $_POST['habitacion_id']:null;
    if ($habitacion_id != null) {
        $insertarAlerta=$con->prepare("INSERT INTO alertas(alerta_id, habitacion_id, fecha_hora) values(NULL, :habitacion_id, current_timestamp());");
        $arrayAlerta=[":habitacion_id"=>$habitacion_id];
        $insertarAlerta->execute();
        if(!($insertarAlerta->rowCount()>0)){

        }
    }
}
?>