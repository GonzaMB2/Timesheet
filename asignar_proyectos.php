<?php 
session_start();
include "db_conn.php";

if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 2) {
    if (isset($_POST['asignarproyecto'])) {
        $nombreProyecto = mysqli_real_escape_string($conn, $_POST['nombre_proyecto']);
        $DNI = mysqli_real_escape_string($conn, $_POST['DNI']);

        $proyectoExistente = mysqli_query($conn, "SELECT * FROM proyectos WHERE nombre_proyecto='$nombreProyecto'");
        
        if (mysqli_num_rows($proyectoExistente) > 0) {
            $sql = "UPDATE empleados SET proyecto='$nombreProyecto' WHERE (Nombre LIKE '%$empleado%' OR Apellido LIKE '%$empleado%' OR DNI = '$DNI')";

            if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn) > 0) {
                header("Location: verempleados.php?success=Proyecto asignado exitosamente.");
                exit();
            } else {
                header("Location: verempleados.php?error=El empleado no existe o no se pudo asignar el proyecto.");
                exit();
            }
        } else {
            header("Location: verempleados.php?error=El proyecto no existe.");
            exit();
        }
    }
} else {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
