<?php 
session_start();
include "db_conn.php";

if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 2) {
    $noResults = false; 
    $where = ""; 

    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $where = "WHERE ID_Proyecto LIKE '%$search%' OR Nombre_Proyecto LIKE '%$search%'";
    }

    $sql = "SELECT * FROM proyectos $where";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $noResults = true; 
    }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Directivos - Información de Proyectos</title>
        <link rel="stylesheet" type="text/css" href="verproyectos.css">
        <script>
            function mostrarPopup() {
                alert("No se encontraron proyectos con los criterios de búsqueda.");
            }
        </script>
    </head>
    <body>
        <h1>Información de Proyectos</h1>
        
        <form method="post" action="verproyectos.php">
            <input type="text" name="search" placeholder="Buscar por ID o Nombre del Proyecto">
            <button type="submit">Buscar</button>
        </form>

        <h2>Crear Nuevo Proyecto</h2>
        <form method="post" action="crear_proyecto.php">
            <input type="text" name="nombre_proyecto" placeholder="Nombre del Proyecto" required>
            <input type="text" name="descripcion" placeholder="Descripción" required></input>
            <button type="submit" name="crearproyecto">Crear Proyecto</button>
        </form>

        <table class="default">
            <thead>
                <tr>
                    <th>ID Proyecto</th>
                    <th>Nombre Proyecto</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['ID_Proyecto'] . "</td>";
                        echo "<td>" . $row['Nombre_Proyecto'] . "</td>";
                        echo "<td>" . $row['Descripcion'] . "</td>";
                        echo "<td>" . $row['Fecha_Inicio'] . "</td>";
                        echo "<td>" . $row['Fecha_Fin'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td>No se encontraron proyectos.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        if ($noResults) {
            echo "<script>mostrarPopup();</script>";
        }
        if (isset($_GET['success'])) {
            echo "<script>alert('" . $_GET['success'] . "');</script>";
        }
        if (isset($_GET['error'])) {
            echo "<script>alert('" . $_GET['error'] . "');</script>";
        }
        ?>  
        <a href="directivos.php"><button>Volver a la pagina principal</button></a>
        <a href="verempleados.php"><button>Ver empleados</button></a>
    </body>
    </html>
    <?php
} else {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
