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

include('db.php');

if (!isset($_GET['id'])) {
    echo "ID no especificado.";
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];

    $stmt = $conn->prepare("UPDATE productos SET nombre=?, precio=? WHERE id=?");
    $stmt->bind_param("sdi", $nombre, $precio, $id);
    if ($stmt->execute()) {
        echo "Producto actualizado con éxito. <a href='read.php'>Volver</a>";
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
    $stmt->close();
    exit();
}

$stmt = $conn->prepare("SELECT * FROM productos WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $product['nombre']; ?>" required><br><br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="<?php echo $product['precio']; ?>" required><br><br>
        <input type="submit" value="Actualizar">
    </form>
    <br>
    <a href="read.php">Volver a la lista de productos</a>
</body>
</html>
