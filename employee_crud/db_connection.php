<?php
$host = "localhost";
$username = "root";  // Tu usuario de MySQL
$password = "";      // Tu contraseña de MySQL
$dbname = "bd_employees_crud";

// Crear la conexión
$conn = mysqli_connect($host, $username, $password, $dbname,3308);

// Verificar la conexión
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

