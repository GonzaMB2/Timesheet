<?php 
session_start();
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 2) {
    header("Location: index.php?error=No tienes acceso a esta página");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Ingreso</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

	<div class="wrapper">
     <form action="Registro.php" method="post">
     	<h1>Registrar empleados</h1>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

         <div class="input-box">
     	<input type="text" name="username" 
		placeholder="Nombre" required>
		<i class='bx bxs-user'></i>
		</div>
        
        <div class="input-box">
     	<input type="text" name="apellido" 
		placeholder="Apellido" required>
		<i class='bx bxs-user'></i>
		</div>

        <div class="input-box">
        <input type="text" name="DNI" pattern="\d+" placeholder="DNI" required title="Por favor, ingrese solo números enteros">
        <i class='bx bxs-lock-alt'></i>
        </div>

        <div class="input-box">
     	<input type="email" name="correo" 
		placeholder="Correo" required>
		<i class='bx bxs-user'></i>
		</div>

        <div class="input-box">
        <input type="text" name="cargo" placeholder="Cargo" required pattern="[1-2]" title="Por favor, ingresa 1 o 2 (1 es para empleados y 2 para directivos)">
        <i class='bx bxs-user'></i>
        </div>
              
     	<button type="submit" class="btn">Ingresar</button>
		<br><br>
		<a class="btn" href="verempleados.php">Volver a los empleados</a>
	</form>
	 
	 </div>

</body>
</html> 