<?php
session_start(); // Inicia la sesión

// Elimina el nombre del usuario de la sesión
unset($_SESSION['usuario']);

// Redirige de nuevo a la página actual para actualizar la visualización
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
