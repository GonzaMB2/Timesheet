<?php
include "db_conn.php";
if (isset($_POST['horas'])) {
    $horas = mysqli_real_escape_string($conn, $_POST['horas']);
    
    $sql = "INSERT INTO horas (`horas`, `Dia`) VALUES ('$horas', NOW())";

    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    else {
        header("Location: home.php");
        exit();
    }
}
?>