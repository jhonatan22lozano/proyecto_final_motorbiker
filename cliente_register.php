<?php
session_start();

$host = '127.0.0.1';
$usuario = 'root'; 
$contraseña = ''; 
$base_datos = 'motorbikee'; 

$conn = new mysqli($host, $usuario, $contraseña, $base_datos);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nombre_com'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_com, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    if ($stmt->execute()) {
        header('Location: login.html');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
}

$conn->close();
?>

