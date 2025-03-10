<?php
require 'db.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}

$stmt = $pdo->query("SELECT id, nombre, email, rol FROM usuarios");
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                <td>
                    <a href="update.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                    <a href="delete.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="admin_dashboard.php">Volver</a>
</body>
</html>

