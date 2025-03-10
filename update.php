<?php
require 'db.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}

if (!isset($_GET['id'])) {
    die("ID de usuario no proporcionado.");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT nombre, email, rol FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if (!$usuario) {
    die("Usuario no encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $rol = $_POST['rol'];

    $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id = ?");
    if ($stmt->execute([$nombre, $email, $rol, $id])) {
        header("Location: read.php");
    } else {
        echo "Error al actualizar usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br><br>

        <label>Rol:</label><br>
        <select name="rol">
            <option value="usuario" <?php if ($usuario['rol'] === 'usuario') echo 'selected'; ?>>Usuario</option>
            <option value="admin" <?php if ($usuario['rol'] === 'admin') echo 'selected'; ?>>Administrador</option>
        </select><br><br>

        <input type="submit" value="Actualizar Usuario">
    </form>
    <a href="read.php">Volver</a>
</body>
</html>
