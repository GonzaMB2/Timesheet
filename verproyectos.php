<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 2) {
    $noResults = false; 
    $where = ""; 
    $alertMessage = "";
    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $where = "WHERE ID_Proyecto LIKE '%$search%' OR Nombre_Proyecto LIKE '%$search%'";
    }

    $sql = "SELECT * FROM proyectos $where";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $noResults = true; 
    }

    if (isset($_POST['finalizar']) && !empty($_POST['finalizar'])) {
        $nombre_proyecto = mysqli_real_escape_string($conn, $_POST['finalizar']);

        $searchProyecto = "SELECT ID_Proyecto FROM proyectos WHERE Nombre_Proyecto = '$nombre_proyecto'";
        $resultSearch = mysqli_query($conn, $searchProyecto);

        if (mysqli_num_rows($resultSearch) > 0) {
            $row = mysqli_fetch_assoc($resultSearch);
            $id_proyecto = $row['ID_Proyecto'];

            $updateProyecto = "UPDATE proyectos SET Fecha_Fin = NOW() WHERE Nombre_Proyecto = '$nombre_proyecto'";

            if (mysqli_query($conn, $updateProyecto)) {
                $updateEmpleados = "UPDATE empleados SET proyecto = NULL WHERE proyecto = '$nombre_proyecto'";

                if (mysqli_query($conn, $updateEmpleados)) {
                    $alertMessage = "Proyecto '$nombre_proyecto' finalizado correctamente y empleados desasignados.";
                    echo "<script>alert('$alertMessage');</script>";
                } else {
                    $alertMessage = "Hubo un error al desasignar a los empleados.";
                    echo "<script>alert('$alertMessage');</script>";
                }
            } else {
                $alertMessage = "Hubo un error al finalizar el proyecto.";
                echo "<script>alert('$alertMessage');</script>";
            }
        } else {
            $alertMessage = "No se encontró un proyecto con ese nombre.";
            echo "<script>alert('$alertMessage');</script>";
        }
    }

    if ($alertMessage != "") {
        echo "<script>alert('$alertMessage');</script>";
    }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Directivos - Información de Proyectos</title>
        <link rel="stylesheet" type="text/css" href="visual.css">
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
            <input type="text" name="descripcion" placeholder="Descripción" required>
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
                    echo "<tr><td colspan='5'>No se encontraron proyectos.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <form method="post" action="verproyectos.php">
            <input type="text" name="finalizar" placeholder="Ingresar Nombre del proyecto a finalizar" required>
            <button type="submit">Finalizar proyecto</button>
        </form>

        <a href="directivos.php"><button>Volver a la página principal</button></a>
        <a href="verempleados.php"><button>Ver empleados</button></a>
        
    </body>
    </html>
    <?php
} else {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
