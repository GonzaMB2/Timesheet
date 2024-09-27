<!DOCTYPE html>
<html>
<head>
	<title>Ingreso</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
     <form action="Cargar.php" method="post">
     	<h2>Proyecto</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Ingrese las horas trabajadas</label>
     	<input type="text" name="horas" placeholder="Horas semanales trabajadas"><br>

     	<label>Ingrese el proyecto en proceso</label>
     	<input type="text" name="proyecto" placeholder="proyecto"><br>
      
      <label>Ingrese el N°de trabajador</label>
     	<input type="text" name="n de trabajador" placeholder="n de trabajador"><br>

     	<button type="submit">Cargar horas</button>
     </form>

     <a href="Tabla.php">Mostrarr</a>
</body>
</html> 