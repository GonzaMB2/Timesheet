<?php 
session_start();
include "db_conn.php";

if (isset($_GET['success'])) {
    echo "<script>alert('" . $_GET['success'] . "');</script>";
}
if (isset($_GET['error'])) {
    echo "<script>alert('" . $_GET['error'] . "');</script>";
}
if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 2) {
    $where = "Cargo != 2";
    $noResults = false; 

    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $where .= " AND (Nombre LIKE '%$search%' OR Apellido LIKE '%$search%' OR DNI = '$search')";

        $sql = "SELECT * FROM empleados WHERE $where";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            $noResults = true; 
            $sql = "SELECT * FROM empleados WHERE Cargo != 2";
            $result = mysqli_query($conn, $sql);
        }
    } else {
        $sql = "SELECT * FROM empleados WHERE $where";
        $result = mysqli_query($conn, $sql);
    }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Directivos - Información de Empleados</title>
        <link rel="stylesheet" type="text/css" href="visual.css">
        <script>
            function mostrarPopup() {
                alert("No se encontraron empleados con los criterios de búsqueda.");
            }
        </script>
    </head>
    <body>
        <h1>Información de Empleados</h1>
        <form method="post" action="verempleados.php">
            <input type="text" name="search" placeholder="Buscar por DNI, Nombre o Apellido">
            <button type="submit">Buscar</button>
        </form>
        <h2>Asignar un proyecto a un empleado</h2>
        <form method="post" action="asignar_proyectos.php">
            <input type="text" name="nombre_proyecto" placeholder="Nombre" required>
            <input type="text" name="empleado" placeholder="Empleado (DNI o Nombre)" required>
            <button type="submit" name="asignarproyecto">Asignar proyecto</button>
        </form>
        <table class="default">
            <thead>
                <tr>
                    <th>DNI del Empleado</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Proyecto actual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['DNI'] . "</td>";
                        echo "<td>" . $row['Nombre'] . "</td>";
                        echo "<td>" . $row['Apellido'] . "</td>";
                        echo "<td>" . $row['Correo'] . "</td>";
                        echo "<td>" . $row['proyecto'] . "</td>";
                        echo "</tr>";

                        if (isset($_POST['search']) && !empty($_POST['search']) && !$noResults) {
                            $dni_empleado = $row['DNI']; 
                            $sql_horas = "SELECT * FROM horas WHERE DNI = '$dni_empleado'"; 
                            $result_horas = mysqli_query($conn, $sql_horas);

                            if (mysqli_num_rows($result_horas) > 0) {
                                echo "<tr><td colspan='6'><h3>Horas Trabajadas</h3></td></tr>";
                                echo "<tr><th>Horas Trabajadas</th><th>Día</th></tr>";

                                while ($row_horas = mysqli_fetch_assoc($result_horas)) {
                                    echo "<tr>";
                                    echo "<td>" . $row_horas['horastrabajadas'] . "</td>";
                                    echo "<td>" . $row_horas['Dia'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No se encontraron horas trabajadas para este empleado.</td></tr>";
                            }
                        }
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron empleados.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        if ($noResults === true) {
            echo "<script>mostrarPopup();</script>";
        }
        ?>
        <a href="agregar_empleados.php"><button>Agregar empleados</button></a>
        <a href="directivos.php"><button>Volver a la página principal</button></a>
        <a href="verproyectos.php"><button>Ver Proyectos</button></a>
    </body>
    </html>
    <?php
} else {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>
