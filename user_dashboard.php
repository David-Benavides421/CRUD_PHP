<?php
require 'db.php';
// No es necesario llamar a session_start() aquí ya que db.php ya lo hace

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .contenedor {
            text-align: center;
            background-color: lightgray;
            padding: 20px;
            border-radius: 10px;
            color: black;
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>Bienvenido, <?php echo htmlspecialchars($usuario); ?></h1>
        
        <div>
            <?php if ($rol === 'admin'): ?>
                <a href="admin_dashboard.php">Panel de Administrador</a>
                <a href="create.php">Crear nuevo usuario</a>
                <a href="read.php">Ver usuarios</a>
            <?php endif; ?>
            
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>