<?php
require 'db.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol = $_POST['rol'];

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$nombre, $email, $password, $rol])) {
        header("Location: read.php");
    } else {
        echo "Error al crear usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Crear Nuevo Usuario</h1>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Rol:</label><br>
        <select name="rol">
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
        </select><br><br>

        <input type="submit" value="Crear Usuario">
    </form>
    <a href="dashboard.php">Volver</a>
</body>
</html>
