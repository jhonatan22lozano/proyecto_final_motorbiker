<?php
session_start(); 


if (isset($_SESSION['usuario'])) {
    header("Location: proyecto.php"); 
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "motorbikee";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND password = ?");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      
        $_SESSION['usuario'] = $email;
        header("Location: proyecto.php");
        exit();
    } else {
        echo "Credenciales incorrectas";
    }

    
    $stmt->close();
    $conn->close();
}
?>


