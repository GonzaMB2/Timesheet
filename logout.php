<?php
session_start();

session_unset(); 
session_destroy(); 

echo '<h1>Has cerrado sesión</h1>';
header ("Location: index.php?=Cerraste la pagina");
?>