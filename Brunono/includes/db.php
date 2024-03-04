<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Nombre de usuario de MySQL
$password = "1234"; // Contraseña de MySQL
$database = "Portal"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
