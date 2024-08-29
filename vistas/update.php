<?php
require_once('../logica/main.php');
$conexion = conectar();

$ide = $_POST['id'];
$page = $_POST['page'];

try {
    if ($page == "listaDePacientes") {
        $sql = "UPDATE pacientes 
                SET paciente_nombre = :nombre, 
                    paciente_apellido = :apellido,
                    paciente_edad = :edad,
                    paciente_domicilio = :domicilio,
                    paciente_datosmedicos = :datos,
                    id_medico = :medico,
                    id_habitacion = :habitacion
                WHERE paciente_id = :ide";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $_POST['new_nombre'],
            ':apellido' => $_POST['new_apellido'],
            ':edad' => $_POST['new_edad'],
            ':domicilio' => $_POST['new_domicilio'],
            ':datos' => $_POST['new_datos'],
            ':medico' => $_POST['opcionMedico'],
            ':habitacion' => $_POST['opcionHabitacion'],
            ':ide' => $ide
        ]);
    } elseif ($page == "listaDeHabitaciones") {
        $sql = "UPDATE habitaciones SET habitacion_nombre = :nombre WHERE habitacion_id = :ide";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $_POST['new_nombre'],
            ':ide' => $ide
        ]);
    } elseif ($page == "listaDeMedicos") {
        $sql = "UPDATE medicos
                SET medico_nombre = :nombre, 
                    medico_apellido = :apellido,
                    medico_dni = :dni,
                    medico_especializacion = :especializacion
                WHERE medico_id = :ide";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $_POST['new_nombre'],
            ':apellido' => $_POST['new_apellido'],
            ':dni' => $_POST['new_dni'],
            ':especializacion' => $_POST['medico_especializacion'],
            ':ide' => $ide
        ]);
    } elseif ($page == "listaDeCuentas") {
        $clave = encriptar($_POST['new_clave']);
        $sql = "UPDATE usuarios 
                SET usuario_nombre = :nombre, 
                    usuario_apellido = :apellido,
                    usuario_email = :email,
                    usuario_clave = :clave,
                    id_cargo = :cargo
                WHERE usuario_id = :ide";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $_POST['new_nombre'],
            ':apellido' => $_POST['new_apellido'],
            ':email' => $_POST['new_email'],
            ':clave' => $clave,
            ':cargo' => $_POST['new_cargo'],
            ':ide' => $ide
        ]);
    } elseif ($page == "listaDeAreas") {
        $sql = "UPDATE areas SET area_nombre = :nombre WHERE area_id = :ide";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $_POST['new_nombre'],
            ':ide' => $ide
        ]);
    }
    echo '<div class="button is-success">¡Actualizado con éxito!</div>';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
