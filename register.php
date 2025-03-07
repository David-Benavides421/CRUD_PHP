<?php
include('db.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nombre   = $_POST['nombre'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    
    $stmt->bind_param("sss", $nombre, $email, $hashedPassword);

    
    if ($stmt->execute()) {
        echo "¡Usuario registrado con éxito! <a href='index.html'>Iniciar sesión</a>";
    } else {
        echo "Error en el registro: " . $conn->error;
    }

    $stmt->close(); 
} else {
    
    header("Location: register.html");
    exit();
}
?>
