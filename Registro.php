<?php 
session_start(); 
include "db_conn.php";

$uname = strtolower($_POST['username']);
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$dni = $_POST['DNI'];
$cargo = $_POST['cargo'];

if (empty($uname)) {
    header("Location: agregar_empleados.php?error=User Name is required");
    exit();
} else if (empty($dni)) { 
    header("Location: agregar_empleados.php?error=DNI is required");
    exit();
} else {
    $sql = "INSERT INTO `empleados`(`DNI`,`Nombre`,`Apellido`, `correo`,`password`, `cargo`) 
            VALUES ('{$dni}', '{$uname}', '{$apellido}', '{$correo}', '{$dni}', '{$cargo}')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: agregar_empleados.php?success=La cuenta ha sido creada con éxito");
        exit();
    } else {
        header("Location: agregar_empleados.php?error=Error al crear la cuenta");
        exit();
    }
}
?>
