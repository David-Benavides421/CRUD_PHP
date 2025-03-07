<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
if ($_SESSION['role'] !== 'admin') {
    echo "No tienes permiso para acceder a esta sección.";
    exit();
}

include('db.php'); // Conexión MySQLi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];

    // Preparamos la consulta para insertar un nuevo producto
    $stmt = $conn->prepare("INSERT INTO productos (nombre, precio) VALUES (?, ?)");
    $stmt->bind_param("sd", $nombre, $precio); // "s" string, "d" double

    if ($stmt->execute()) {
        echo "¡Producto creado con éxito! <a href='read.php'>Ver productos</a>";
    } else {
        echo "Error al crear producto: " . $conn->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Producto</title>
</head>
<body>
    <h1>Crear Producto</h1>
    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" required><br><br>
        <input type="submit" value="Crear">
    </form>
    <br>
    <a href="read.php">Volver a la lista de productos</a>
</body>
</html>