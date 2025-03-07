<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
// Si deseas que solo los administradores vean la lista completa, descomenta la siguiente línea:
// if ($_SESSION['role'] !== 'admin') { echo "No tienes permiso para acceder a esta sección."; exit(); }

include('db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM productos");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['nombre']."</td>";
            echo "<td>".$row['precio']."</td>";
            if ($_SESSION['role'] === 'admin') {
                echo "<td>
                      <a href='update.php?id=".$row['id']."'>Editar</a> |
                      <a href='delete.php?id=".$row['id']."'>Eliminar</a>
                      </td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="create.php">Crear nuevo producto</a>
    <?php endif; ?>
</body>
</html>
