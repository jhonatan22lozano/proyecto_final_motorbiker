password
<?php
session_start();


$conn = new mysqli('127.0.0.1', 'root', '', 'motorbikee');


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];

   
    $sql = "SELECT * FROM administradores WHERE usuario = '$usuario' AND password = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo'] = 'administrador'; 

        
        header("Location: c_usuarios.php");
        exit();
    } else {
        
        echo "Usuario o contraseña incorrectos";
    }
}
?>


