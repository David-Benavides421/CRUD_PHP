<?php
session_start();
include('db.php'); // Incluye la conexión MySQLi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibimos los datos del formulario (coinciden con los name del index.html)
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Preparamos la consulta para buscar el usuario por su email
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

   
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nombre']  = $user['nombre'];
            $_SESSION['role'] = $user['role'];
            
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }

    $stmt->close();
}
?>
