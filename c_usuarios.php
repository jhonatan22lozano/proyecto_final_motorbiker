<?php
session_start();

// Datos de conexión a la base de datos
$host = '127.0.0.1';
$usuario = 'root'; // Cambia esto si tu usuario es diferente
$contraseña = ''; // Cambia esto si tu contraseña es diferente
$base_datos = 'motorbikee'; // Asegúrate de que el nombre de la base de datos sea correcto

// Conexión a la base de datos
$conn = new mysqli($host, $usuario, $contraseña, $base_datos);

// Verifica si hay errores en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si el administrador está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}

// Obtener la lista de usuarios
$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);

// Manejo de operaciones de edición y eliminación
if (isset($_POST['editar'])) {
    $email_usuario = $_POST['email_usuario'];
    $nuevo_nombre = $_POST['nombre_usuario'];
    $nuevo_email = $_POST['nuevo_email'];

    // Verifica qué campos han sido enviados para actualizar
    if (!empty($nuevo_nombre) && !empty($email_usuario)) {
        $sql = "UPDATE usuarios SET nombre_com='$nuevo_nombre' WHERE email='$email_usuario'";
        $conn->query($sql);
    }

    if (!empty($nuevo_email) && !empty($email_usuario)) {
        $sql = "UPDATE usuarios SET email='$nuevo_email' WHERE email='$email_usuario'";
        $conn->query($sql);
    }

    header('Location: c_usuarios.php'); // Redirige a la misma página para ver los cambios
    exit();
}

if (isset($_POST['eliminar'])) {
    $email_usuario = $_POST['email_usuario'];

    $sql = "DELETE FROM usuarios WHERE email='$email_usuario'";
    $conn->query($sql);
    header('Location: c_usuarios.php'); // Redirige a la misma página para ver los cambios
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Usuarios</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <header>
        <h1>Control de Usuarios</h1>
        <p>Administra los usuarios registrados en la base de datos.</p>
    </header>
    
    <main class="container">
        <h2>Lista de Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_com']); ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="email_usuario" value="<?php echo htmlspecialchars($row['email']); ?>">
                                <input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
                            </form>
                            <button onclick="editarUsuario('<?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars($row['nombre_com'], ENT_QUOTES, 'UTF-8'); ?>')">Editar</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div id="editar-form" style="display:none;">
            <h2>Editar Usuario</h2>
            <form method="post">
                <input type="hidden" name="email_usuario" id="email_usuario">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="nombre_usuario" id="nombre_usuario">
                </div>
                <div class="form-group">
                    <label>Nuevo Email:</label>
                    <input type="email" name="nuevo_email" id="nuevo_email">
                </div>
                <input type="submit" name="editar" value="Guardar Cambios" class="btn">
            </form>
        </div>
    </main>

    <script>
        function editarUsuario(email, nombre) {
            document.getElementById('email_usuario').value = email;
            document.getElementById('nombre_usuario').value = nombre;
            document.getElementById('editar-form').style.display = 'block';
        }
    </script>
</body>
</html>
