<!DOCTYPE html>
<html>
<head>
	<title>Ingreso</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="Login.php" method="post">
     	<h2>Inicio de sesion</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Usuario</label>
     	<input type="text" name="username" placeholder="Usuario"><br>

     	<label>Contraseña</label>
     	<input type="password" name="password" placeholder="password"><br>
      
     	<button type="submit">Ingresar</button>
     </form>

</body>
</html> 