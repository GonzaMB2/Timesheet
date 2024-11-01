<?php 
session_start();
include "db_conn.php";

if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 2) {
    if (isset($_POST['asignarproyecto'])) {
        $nombreProyecto = mysqli_real_escape_string($conn, $_POST['nombre_proyecto']);
        $empleado = mysqli_real_escape_string($conn, $_POST['empleado']);

        $sql = "UPDATE empleados SET proyecto='$nombreProyecto' WHERE (Nombre LIKE '%$empleado%' OR Apellido LIKE '%$empleado%' OR ID_Empleado = '$empleado')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: verempleados.php?success=Proyecto asignado exitosamente.");
            echo "<script>alert('El proyecto se asigno correctamente');</script>";
            exit();
        } else {
            header("Location: verempleados.php?error=Error al asignar el proyecto: " . mysqli_error($conn));
            exit();
        }
    }
} else {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
