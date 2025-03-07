<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        .contenedor {
            text-align: center;
            background-color: lightgray;
            padding: 20px;
            border-radius: 10px;
            font-family: Arial, sans-serif;
            color: black;
        }
    </style>
</head>
<body>
    <div class="contenedor">
    <h1>Bienvenido, <?php echo $_SESSION['nombre']?>, eres el <?php echo $_SESSION['role']; ?>!</h1>
    <p>Esta es tu área privada.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>