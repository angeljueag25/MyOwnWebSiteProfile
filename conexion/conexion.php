<?php
$host = "localhost";
$user = "root";
$password = ""; // En XAMPP la contraseña por defecto de root es vacía
$dbname = "portafolio_db";

$conexion = new mysqli($host, $user, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Configurar conjunto de caracteres a UTF-8
$conexion->set_charset("utf8mb4");
?>