<?php
// Incluir conexión a la base de datos
include 'db_connection.php';

// Verificar si se ha pasado un ID para eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consultar los detalles del empleado antes de eliminar
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

// Verificar si el formulario ha sido enviado para eliminar el empleado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Eliminar el empleado de la base de datos
    $query = "DELETE FROM employees WHERE ID = '$id'";
    
    if (mysqli_query($conn, $query)) {
        echo "Empleado eliminado correctamente!";
        // Redirigir a la página de listado
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el empleado: " . mysqli_error($conn);
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
    <title>Delete Employee</title>
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
                <th>Identity Document</th>
                <th>Address</th>
                <th>Telephone</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td data-label="ID"><?php echo $row['ID']; ?></td>
                <td data-label="Name"><?php echo $row['name']; ?></td>
                <td data-label="Lastname"><?php echo $row['lastname']; ?></td>
                <td data-label="Email"><?php echo $row['email']; ?></td>
                <td data-label="Document"><?php echo $row['identity_document']; ?></td>
                <td data-label="Address"><?php echo $row['Address']; ?></td>
                <td data-label="Phone"><?php echo $row['Telephone']; ?></td>
                <td>
                
                <a href="delete_employee.php?id=<?php echo $row['ID']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        </div>

        <?php if (isset($employee)) { ?>
        <h2>Delete Employee</h2>
        <form method="POST">
            <p>Are you sure you want to delete the following employee?</p>
            <p>Name: <?php echo $employee['name']; ?> <?php echo $employee['lastname']; ?></p>
            <p>Email: <?php echo $employee['email']; ?></p>
            <p>Identity Document: <?php echo $employee['identity_document']; ?></p>
            <input type="submit" value="Delete Employee">
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

