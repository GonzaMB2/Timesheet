<?php 
session_start();
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 2) {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Directivos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Bienvenido, Directivo</h1>
        <p>Seleccione una opción:</p>
        
        <div class="input-box">
            <a href="verempleados.php"><button class="btn">Ver Empleados</button></a>
            <br><br>
            <a href="verproyectos.php"><button class="btn">Ver Proyectos</button></a>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <br>    
        <div class="input-box">
        <form action="logout.php" method="POST">
            <button class="btn" >Logout</button>
        </form>
        </div>
    </div>
</body>
</html>
