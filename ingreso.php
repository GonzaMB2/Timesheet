<?php 
session_start();
include "db_conn.php";

if (isset($_POST['Horas'])) {
    $horas = mysqli_real_escape_string($conn, $_POST['Horas']);
    
    // Usar comillas dobles para que $_SESSION se interprete correctamente
    $sql = "INSERT INTO `horas`(`horastrabajadas`, `Dia`, `ID_Empleado`) VALUES ('$horas', NOW(), '{$_SESSION['id']}')";
    
    if (mysqli_query($conn, $sql)) {
        // Redirigir con un mensaje de éxito
        header("Location: home.php?success=Horas asignadas correctamente.");
        exit();
    } else {
        // Redirigir con un mensaje de error
        header("Location: home.php?error=Error al asignar el proyecto: " . mysqli_error($conn));
        exit();
    }
} else {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
