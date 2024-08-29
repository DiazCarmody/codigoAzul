<?php
    // require_once('../reciclar/session.php');
    session_destroy();
    if(headers_sent()){
        echo "<script> window.location.href'index.php?vista=iniciarSesion';</script>";
    }else{
        header("./index.php?vista=iniciarSesion");
    }
?>