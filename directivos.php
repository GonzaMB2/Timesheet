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
    <link rel="stylesheet" type="text/css" href="directivos.css">
</head>
<body>
    <h1>Bienvenido, Directivo</h1>
    <p>Seleccione una opción:</p>
    
        <a href="verempleados.php"><button>Ver Empleados</button></a>
        <a href="verproyectos.php"><button>Ver Proyectos</button></a>
</body>
<footer>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <form action="logout.php" method="POST">
        <button class="logout-button">Logout</button>
    </form></footer>
</html>
