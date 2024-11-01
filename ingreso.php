<?php 
session_start();
include "db_conn.php";

if (isset($_POST['Horas'])) {
    $horas = mysqli_real_escape_string($conn, $_POST['Horas']);
    
    $sql = "INSERT INTO `horas`(`horastrabajadas`, `Dia`, `ID_Empleado`) VALUES ('$horas', NOW(), '{$_SESSION['id']}')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: home.php?success=Horas asignadas correctamente.");
        exit();
    } else {
        header("Location: home.php?error=Error al asignar el proyecto: " . mysqli_error($conn));
        exit();
    }
} else {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
