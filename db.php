<?php
// db.php - Conexión a la base de datos usando PDO para mayor seguridad

$host = 'localhost';
$dbname = 'mi_basedatos';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Función para verificar si el usuario está autenticado
function verificar_sesion() {
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.html");
        exit();
    }
}

// Función para verificar si el usuario es admin
function es_admin() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
}
?>