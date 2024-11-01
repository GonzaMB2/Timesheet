<?php 
session_start();
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 2) {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio Directivos</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
    <h1>Bienvenido, Directivo</h1>
    <p>Seleccione una opción:</p>
    <div>
        <a href="verempleados.php"><button>Ver Empleados</button></a>
        <a href="verproyectos.php"><button>Ver Proyectos</button></a>
    </div>
</body>
</html>
