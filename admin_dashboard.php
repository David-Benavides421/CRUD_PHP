<?php
include 'db.php';
verificar_sesion();

// Verificar si el usuario es admin
if (!es_admin()) {
    header("Location: user_dashboard.php"); // Cambio de dashboard.php a user_dashboard.php
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Bienvenido, Administrador</h1>
    <p>Gestiona usuarios y datos del sistema.</p>
    
    <h2>Lista de Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php
        $stmt = $pdo->query("SELECT * FROM usuarios");
        while ($usuario = $stmt->fetch()) {
            echo "<tr>
                    <td>{$usuario['id']}</td>
                    <td>" . htmlspecialchars($usuario['nombre']) . "</td>
                    <td>" . htmlspecialchars($usuario['email']) . "</td>
                    <td>" . htmlspecialchars($usuario['rol']) . "</td>
                    <td><a href='update.php?id={$usuario['id']}'>Editar</a> | 
                        <a href='delete.php?id={$usuario['id']}' onclick='return confirm(\"¿Está seguro que desea eliminar este usuario?\");'>Eliminar</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
    
    <br>
    <a href="create.php">Crear nuevo usuario</a> |
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>