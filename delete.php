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

$stmt = $conn->prepare("DELETE FROM productos WHERE id=?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo "Producto eliminado con éxito. <a href='read.php'>Volver</a>";
} else {
    echo "Error al eliminar: " . $conn->error;
}
$stmt->close();
?>
