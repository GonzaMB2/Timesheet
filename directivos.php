<?php 
session_start();
include "db_conn.php";

if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 2) {

    $where = "";
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $where = "WHERE Nombre LIKE '%$search%' OR Apellido LIKE '%$search%' OR ID_Empleado = '$search'";
    }

    $sql = "SELECT ID_Empleado, Nombre, Apellido, Correo, Departamento, Proyecto FROM empleados $where";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Directivos - Información de Empleados</title>
            <link rel="stylesheet" type="text/css" href="style_directivos.css"> <!-- Enlace al archivo CSS -->
        </head>
        <body>
            
                <h1>Información de Empleados</h1>
                <form method="post" action="directivos.php">
                    <input type="text" name="search" placeholder="Buscar por ID, Nombre o Apellido">
                    <button type="submit">Buscar</button>
                </form>

                <table class="default">
                    <thead>
                        <tr>
                            <th>ID del Empleado</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Departamento</th>
                            <th>Proyecto</th>
                        </tr>
                    </thead>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['ID_Empleado'] . "</td>";
                            echo "<td>" . $row['Nombre'] . "</td>";
                            echo "<td>" . $row['Apellido'] . "</td>";
                            echo "<td>" . $row['Correo'] . "</td>";
                            echo "<td>" . $row['Departamento'] . "</td>";
                            echo "<td>" . $row['Proyecto'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                </table>
    
        </body>
        </html>
        <?php
    } else {
        echo "No se encontraron empleados.";
    }
} else {
    // Si no es un directivo, redirigir al login o a otra página
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
