<?php
session_start();
include "db_conn.php";

if (!isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($new_password) || empty($confirm_password)) {
        header("Location: cambiar.php?error=Por favor, complete ambos campos.");
        exit();
    }

    if ($new_password !== $confirm_password) {
        header("Location: cambiar.php?error=Las contraseñas no coinciden.");
        exit();
    }


    $sql = "UPDATE empleados SET password='$new_password' WHERE DNI='$_SESSION[DNI]'";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?success=Contraseña cambiada con éxito.");
        exit();
    } else {
        header("Location: cambiar.php?error=Hubo un error al cambiar la contraseña.");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="cambiar.php" method="POST">
            <h1>Cambiar Contraseña</h1>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            
            <div class="input-box">
                <input type="password" name="new_password" placeholder="Nueva Contraseña" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            
            <div class="input-box">
                <input type="password" name="confirm_password" placeholder="Confirmar Nueva Contraseña" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" class="btn">Cambiar Contraseña</button>
        </form>
    </div>
</body>
</html>
