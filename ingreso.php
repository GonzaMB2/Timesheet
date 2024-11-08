<?php
session_start();
include "db_conn.php";

if (isset($_POST['Horas'])) {
    $horas = mysqli_real_escape_string($conn, $_POST['Horas']);
    $dni = $_SESSION['DNI'];
    $proyecto = $_SESSION['proyecto'];
    
    $fechaHoy = date('Y-m-d');

    $sql_check = "SELECT * FROM `horas` WHERE `DNI` = '$dni' AND `Proyecto` = '$proyecto' AND DATE(`Dia`) = '$fechaHoy'";

    $result = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result) > 0) {
        echo "<script type='text/javascript'>
                alert('No puedes asignar horas más de una vez en el mismo día.');
                window.location.href = 'home.php';
              </script>";
        exit();
    } else {
        $sql = "INSERT INTO `horas` (`horastrabajadas`, `Dia`, `DNI`, `Proyecto`) 
                VALUES ('$horas', NOW(), '$dni', '$proyecto')";

        if (mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>
                    alert('Horas asignadas correctamente.');
                    window.location.href = 'home.php';
                  </script>";
            exit();
        }
        }
}
?>
