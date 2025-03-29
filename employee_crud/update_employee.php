<?php
// Incluir conexión a la base de datos
include 'db_connection.php';

// Verificar si se ha pasado un ID para editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consultar los detalles del empleado
    $query = "SELECT * FROM employees WHERE ID = '$id'";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conn));
    }
    
    // Obtener los datos del empleado
    $employee = mysqli_fetch_assoc($result);
    
    if (!$employee) {
        die("Empleado no encontrado.");
    }
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $identity_document = $_POST['identity_document'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    
    // Actualizar la información en la base de datos
    $query = "UPDATE employees SET 
              name = '$name',
              lastname = '$lastname',
              email = '$email',
              identity_document = '$identity_document',
              address = '$address',
              telephone = '$telephone'
              WHERE ID = '$id'";
    
    if (mysqli_query($conn, $query)) {
        echo "Employee updated successfully!";
        // Redirigir a la página de listado
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Consultar empleados
$query = "SELECT * FROM employees";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <div class="container-crud">
        <h1>List of Employees</h1>
        <div class="table-container">
        <table>
            <tr>
            <th>ID</th>
                <th>Name</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>identity_document</th>
                <th>Address</th>
                <th>Telephone</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
            <td data-label="ID"><?php echo $row['ID']; ?></td>    
                <td data-label="Name"><?php echo $row['name']; ?></td>
                <td data-label="lastname"><?php echo $row['lastname']; ?></td>
                <td data-label="email"><?php echo $row['email']; ?></td>
                <td data-label="Identification"><?php echo $row['identity_document']; ?></td>
                <td data-label="Address"><?php echo $row['Address']; ?></td>
                <td data-label="Telephone"><?php echo $row['Telephone']; ?></td>
                <td data-label="Photo"><?php echo $row['Photo']; ?></td>
                <td>
                <a href="update_employee.php?id=<?php echo $row['ID']; ?>">Edit</a> 
                    
                </td>
            </tr>
            <?php } ?>
        </table>
        </div>

        <?php if (isset($employee)) { ?>
        <h2>Edit Employee</h2>
        <form method="POST">
            <input type="text" name="name" value="<?php echo $employee['name']; ?>" placeholder="Name" required><br><br>
            <input type="text" name="lastname" value="<?php echo $employee['lastname']; ?>" placeholder="Lastname" required><br><br>
            <input type="email" name="email" value="<?php echo $employee['email']; ?>" placeholder="Email" required><br><br>
            <input type="text" name="identity_document" value="<?php echo $employee['identity_document']; ?>" placeholder="Identity Document" required><br><br>
            <input type="text" name="address" value="<?php echo $employee['Address']; ?>" placeholder="Address" required><br><br>
            <input type="text" name="telephone" value="<?php echo $employee['Telephone']; ?>" placeholder="Telephone" required><br><br>
            <input type="file" name="photo" value="<?php echo $employee['Photo']; ?>"><br><br>
            <input type="submit" value="Update Employee">
        </form>
        <?php } ?>

        <!-- Botón para volver al inicio -->
        <br><br>
        <a href="index.php">
            <button>Volver al Inicio</button>
        </a>    

    </div>
</body>
</html>
