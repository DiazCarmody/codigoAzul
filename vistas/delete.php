<?php
    require_once('../logica/main.php');
    $conexion=conectar();

    $ide = $_POST['id'];
    $page = $_POST['page'];

    if($page == "listaDePacientes"){
        $sql = ("DELETE FROM pacientes where paciente_id = $ide");
        $ejecutar = $conexion->query($sql);

        header("Location: ../index.php?vista=listaDePacientes");
        exit();
    }
    else if($page == "listaDeHabitaciones"){
        $sql = ("DELETE FROM habitaciones where habitacion_id = $ide");
        $ejecutar = $conexion->query($sql);

        header("Location: ../index.php?vista=listaDeHabitaciones");
        exit();
    }
    else if($page == "listaDeMedicos"){
        $sql = ("DELETE FROM medicos where medico_id = $ide");
        $ejecutar = $conexion->query($sql);

        header("Location: ../index.php?vista=listaDeMedicos");
        exit();
    }
    else if($page == "listaDeCuentas"){
        $sql = ("DELETE FROM usuarios where usuario_id = $ide");
        $ejecutar = $conexion->query($sql);

        header("Location: ../index.php?vista=listaDeCuentas");
        exit();
    }
    else if($page == "listaDeAreas"){
        $sql = ("DELETE FROM areas where area_id = $ide");
        $ejecutar = $conexion->query($sql);

        header("Location: ../index.php?vista=listaDeAreas");
        exit();
    }

?>