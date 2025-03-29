<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_employees_crud";

$conn = new mysqli($servername, $username, $password, $dbname,3308);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Incluir la conexión a la base de datos
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $identity_document = $_POST['identity_document'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $photo = $_FILES['photo']['name'];

    // Subir foto
    move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $photo);

    // Insertar en la base de datos
    $query = "INSERT INTO employees (name, lastname, email, identity_document, address, telephone, photo) 
              VALUES ('$name', '$lastname', '$email', '$identity_document', '$address', '$telephone', '$photo')";
    
    if (mysqli_query($conn, $query)) {
        // Redirigir a la página principal (index.php) después de agregar el empleado
        header("Location: index.php");
        exit(); // Detener la ejecución para evitar que se muestre el mensaje
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <div class="container">
        <h1>Add Employee</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name" required><br><br>
            <input type="text" name="lastname" placeholder="Lastname" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="text" name="identity_document" placeholder="Identity Document" required><br><br>
            <input type="text" name="address" placeholder="Address" required><br><br>
            <input type="text" name="telephone" placeholder="Telephone" required><br><br>
            <input type="file" name="photo"><br><br>
            <input type="submit" value="Add Employee">
        </form>
    </div>
</body>
</html>




