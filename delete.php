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
$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");

if ($stmt->execute([$id])) {
    header("Location: read.php");
} else {
    echo "Error al eliminar usuario.";
}
?>
