<?php 
session_start();
include "db_conn.php";
$sql = "SELECT * FROM proyectos";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Proyectos</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<header><h1>Bienvenido, <?php echo $_SESSION['name']; ?></h1>
<h2>Tu ID de usuario es: <?php echo $_SESSION['id']; ?></h2>
<h3>Proyecto asignado: <?php echo $_SESSION['Proyecto']; ?></h3>
</header>
<body align="center">
     
     <table class="default">
        <tr align="center">
            <th>|</th>
            <th>ID del Proyecto</th>
            <th>|</th>
            <th>Nombre del Proyecto</th>
            <th>|</th>
            <th>Descripción</th>
            <th>|</th>
            <th>Horas Trabajadas</th>
            <th>|</th>
            <th>Día</th>
            <th>|</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr align='center'>
                <td>|</td>
                <td><?php echo $row['ID_Proyecto']; ?></td>   
                <td>|</td>
                <td><?php echo $row['Nombre_Proyecto']; ?></td>  
                <td>|</td>
                <td><?php echo $row['Descripcion']; ?></td>   
                <td>|</td>
                <td><?php echo $row['Horas trabajadas']; ?></td>
                <td>|</td>
                <td><?php echo $row['Dia']; ?></td>
                <td>|</td>
            </tr>
        <?php } ?>
    </table>
 <footer>
    <form action="ingreso.php" method="post">
    <label >Inbresar horas Trabajadas</label> <br>
    <input type="text" name="Horas" placeholder="Ingresar horas Trabajadas"><br>
    <Button type="submit">Cargar</Button>
    </form>
 </footer>
</body>
</html>
