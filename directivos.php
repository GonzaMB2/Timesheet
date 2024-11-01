<?php 
session_start();
include "db_conn.php";

if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 2) {

    $where = "Cargo != 2";

    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $where .= " AND (Nombre LIKE '%$search%' OR Apellido LIKE '%$search%' OR ID_Empleado = '$search')";
    }

    $sql = "SELECT * FROM empleados WHERE $where";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Directivos - Información de Empleados</title>
            <link rel="stylesheet" type="text/css" href="home.css">
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['ID_Empleado'] . "</td>";
                        echo "<td>" . $row['Nombre'] . "</td>";
                        echo "<td>" . $row['Apellido'] . "</td>";
                        echo "<td>" . $row['Correo'] . "</td>";
                        echo "<td>" . $row['Departamento'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </body>
        <?php
        } else {
            echo "<script>document.getElementById('error-message').style.display = 'block';</script>";
        }
        ?>
        </html>
        <?php
    }  else {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
