<!DOCTYPE html>
<html>

<head>
	<title>Ingreso</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

	<div class="wrapper">
     <form action="Login.php" method="post">
     	<h1>Inicio de sesion</h1>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

		<div class="input-box">
     	<input type="text" name="username" 
		placeholder="Usuario" required>
		<i class='bx bxs-user'></i>
		</div>

     	<div class="input-box">
     	<input type="password" name="password" 
		placeholder="password" required>
		<i class='bx bxs-lock-alt'></i>
		</div>
      
     	<button type="submit" class="btn">Ingresar</button>
     </form>
	 </div>
</body>
</html> 