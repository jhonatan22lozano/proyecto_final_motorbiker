<?php
session_start(); 


if (isset($_SESSION['usuario'])) {
    $nombre_usuario = $_SESSION['usuario'];
} else {
    $nombre_usuario = ''; 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotorBike | Tienda de Repuestos</title>

    <style>
        
        header {
            position: relative;
            padding: 20px;
        }
        .user-info {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 16px;
        }
        .auth-container {
            position: absolute;
            top: 50px;
            right: 20px;
            padding: 10px;
            border: 1px solid #007BFF;
            background-color: #f4f4f4;
            border-radius: 5px;
            margin-top: 10px;
        }
        .auth-container a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            display: block;
            text-align: center;
            padding: 5px 10px;
            background-color: white;
            border-radius: 4px;
        }
        .auth-container a:hover {
            background-color: #007BFF;
            color: white;
        }

       
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: white;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .whatsapp-float:hover {
            background-color: #128c7e;
        }

        .whatsapp-icon {
            margin-top: 13px;
        }

        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
            color: #333;
            scroll-behavior: smooth;
        }

        header {
            background: linear-gradient(135deg, #1e1e1e, #4d4d4d);
            color: white;
            padding: 50px 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            letter-spacing: 2px;
            animation: fadeIn 1s ease-in-out;
        }

        header p {
            font-size: 1.3rem;
            margin-top: 0;
            font-style: italic;
            animation: fadeIn 1.5s ease-in-out;
        }

        nav {
            background-color: #333;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #ff6600;
            color: white;
            box-shadow: 0 4px 12px rgba(255, 102, 0, 0.3);
        }

        main {
            padding: 50px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

       
        section {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #333;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 30px 0;
        }

        footer a {
            color: #ff6600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: white;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        
        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
                gap: 10px;
            }

            section h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
   
    <header>
        <h1>MB Tienda de Repuestos</h1>
        <p>¡Todo lo que tu moto o bicicleta necesita, lo encuentras aquí! Calidad garantizada, precios imbatibles y el mejor servicio para mantenerte en movimiento.</p>
        <?php if ($nombre_usuario): ?>
            <div class="user-info">Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?>!</div>
            <div class="auth-container">
                <a href="logout.php">Cerrar Sesión</a>
            </div>
        <?php else: ?>
            <div class="auth-container">
                <a href="login.html">Iniciar Sesión</a>
            </div>
        <?php endif; ?>
    </header>
    
   
    <nav>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#motos">Repuestos de Motos</a></li>
            <li><a href="#bicicletas">Repuestos de Bicicletas</a></li>
            <li><a href="#servicios">Servicios</a></li>
        </ul>
    </nav>

  
    <main>
      
        <section id="motos">
            <h2>Repuestos de Motos</h2>
           
        </section>

        
        <section id="bicicletas">
            <h2>Repuestos de Bicicletas</h2>
            
        </section>
        
        
        <section id="servicios">
            <h2>Nuestros Servicios</h2>
           
        </section>
    </main>

    
    <footer>
        <p>© 2024 MB Tienda de Repuestos. Todos los derechos reservados.</p>
        <p><a href="#">Política de privacidad</a> | <a href="#">Términos de uso</a></p>
    </footer>

   
    <a href="https://wa.me/1234567890" class="whatsapp-float" target="_blank">
         <img src="img/whatsapp-logo-png.webp">
    </a>
</body>
</html>
