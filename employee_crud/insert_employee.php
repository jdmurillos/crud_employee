<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_employees_crud";

$conn = new mysqli($servername, $username, $password, $dbname,3308);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recuperando los datos del formulario
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$identity_document = $_POST['identity_document'];
$address = $_POST['address'];
$telephone = $_POST['telephone'];

// Subida de la foto
$photo = $_FILES['photo']['name'];
$photo_temp = $_FILES['photo']['tmp_name'];
$photo_path = "uploads/" . $photo;

// Mover la foto a la carpeta "uploads"
move_uploaded_file($photo_temp, $photo_path);

// Insertar los datos en la base de datos
$sql = "INSERT INTO employees (name, lastname, email, identity_document, address, telephone, photo)
        VALUES ('$name', '$lastname', '$email', '$identity_document', '$address', '$telephone', '$photo')";

if ($conn->query($sql) === TRUE) {
    echo "New employee added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

