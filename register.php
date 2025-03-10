<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_2 = $_POST['password_2'];
    $rol = 'usuario'; // Por defecto

    if ($password !== $password_2) {
        die("Las contraseñas no coinciden.");
    }

    // Verificar si el usuario ya existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        die("El correo ya está registrado.");
    }

    // Encriptar contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar en la base de datos
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$nombre, $email, $password_hash, $rol])) {
        header("Location: index.html");
    } else {
        die("Error al registrar usuario.");
    }
}
