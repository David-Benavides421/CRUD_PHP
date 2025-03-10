<?php
require 'db.php';

// Verificar si ya existe un administrador
$stmt = $pdo->query("SELECT id FROM usuarios WHERE rol = 'admin' LIMIT 1");
if ($stmt->fetch()) {
    die("Ya existe un administrador en el sistema.");
}

// Crear administrador predeterminado
$nombre = "Administrador";
$email = "admin@sistema.com";
$password = password_hash("admin123", PASSWORD_BCRYPT);
$rol = "admin";

$stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
if ($stmt->execute([$nombre, $email, $password, $rol])) {
    echo "Administrador creado con éxito.<br>";
    echo "Email: admin@sistema.com<br>";
    echo "Contraseña: admin123<br>";
    echo "<a href='index.html'>Ir al login</a>";
} else {
    echo "Error al crear el administrador.";
}
?>