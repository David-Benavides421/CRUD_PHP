<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "login_system";

// Crear la conexión usando MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
