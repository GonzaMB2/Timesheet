<?php 
session_start();
include "db_conn.php";

if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 2) {
    if (isset($_POST['crearproyecto'])) {
        $nombreProyecto = mysqli_real_escape_string($conn, $_POST['nombre_proyecto']);
        $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);

        $insertSql = "INSERT INTO proyectos (Nombre_Proyecto, Descripcion, Fecha_Inicio) 
                      VALUES ('$nombreProyecto', '$descripcion', NOW())";
        
        if (mysqli_query($conn, $insertSql)) {
            header("Location: verproyectos.php?success=Proyecto creado exitosamente.");
            exit();
        } else {
            header("Location: verproyectos.php?error=Error al crear el proyecto: " . mysqli_error($conn));
            exit();
        }
    }
} else {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
