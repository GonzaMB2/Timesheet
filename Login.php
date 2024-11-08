<?php 
session_start(); 
include "db_conn.php"; 

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data) {
       $data = trim($data); 
       $data = stripslashes($data); 
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = strtolower(validate($_POST['username']));
    $pass = validate($_POST['password']); 

    if (empty($uname)) {
        header("Location: index.php?error=El nombre de usuario es requerido");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=La contraseña es requerida");
        exit();
    } else {
        $sql = "SELECT * FROM empleados WHERE Nombre='$uname'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['Nombre'] === $uname && $row['password'] === $pass) {
                $_SESSION['user_name'] = $row['Nombre']; 
                $_SESSION['name'] = $row['Nombre'];
                $_SESSION['DNI'] = $row['DNI']; 
                $_SESSION['proyecto'] = $row['proyecto'];
                $_SESSION['cargo'] = $row['Cargo']; 

				if ($row['password'] == strval($row['DNI'])) {
                    header("Location: cambiar.php");
                    exit();
                } else if ($row['Cargo'] == 2) {
                    header("Location: directivos.php");
                    exit();
                } else if ($row['Cargo'] == 1) {
                    header("Location: home.php");
                    exit();
                } else {
                    header("Location: index.php?error=Nombre de usuario o contraseña incorrectos");
                    exit();
                }
            } else {
                header("Location: index.php?error=Nombre de usuario o contraseña incorrectos");
                exit();
            }
        } else {
            header("Location: index.php?error=Nombre de usuario o contraseña incorrectos");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
