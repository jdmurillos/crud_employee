
<?php

$servername = "localhost"; // Cambia según tu configuración
$username = "root"; // Usuario de tu base de datos
$password = ""; // Contraseña de tu base de datos
$dbname = "bd_employees_crud"; // Nombre de tu base de datos

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname,3308);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario de búsqueda
$empleado = null;
if (isset($_POST['buscar'])) {
    $id_empleado = $_POST['id_empleado'];

    // Consulta SQL para buscar al empleado por ID
    $sql = "SELECT * FROM employees WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $empleado = $resultado->fetch_assoc();
    } else {
        $mensaje = "No se encontró ningún empleado con el ID: " . htmlspecialchars($id_empleado);
    }

    $stmt->close();
}

$conn->close();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees Form</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
<div class="container">
        <h1>Employees Form</h1>
        <div class="button-container">
            <a href="add_employee.php" class="button">Add Employee</a>
            <a href="read_employee.php" class="button">List Employees</a>
            <a href="update_employee.php" class="button">Update Employees</a>
            <a href="delete_employee.php" class="button">Delete Employee</a>
        </div>

        <!-- Formulario de búsqueda -->
        <div class="search-container">
            <h3>Search Employee by ID</h3>
            <form method="post">
                <input type="number" name="id_empleado" placeholder="Enter Employee ID" required>
                <button type="submit" name="buscar">Search</button>
            </form>
        </div>

        <!-- Mostrar resultados -->
        <div class="result-container">
            <?php if (isset($mensaje) && !empty($mensaje)): ?>
                <p class="error"><?php echo htmlspecialchars($mensaje); ?></p>
            <?php elseif (isset($empleado) && !empty($empleado)): ?>
                <div class="employee-info">
                    <h3>Employee Information</h3>
                    <p><strong>ID:</strong> <?php echo htmlspecialchars($empleado['ID']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($empleado['name']) . " " . htmlspecialchars($empleado['lastname']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($empleado['email']); ?></p>
                    <p><strong>Identity Document:</strong> <?php echo htmlspecialchars($empleado['identity_document']); ?></p>
                    <p><strong>Telephone:</strong> <?php echo htmlspecialchars($empleado['Telephone']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($empleado['Address']); ?></p>
                    <?php if (!empty($empleado['Photo'])): ?>
                        <p><strong>Photo:</strong></p>
                        <img src="uploads/<?php echo htmlspecialchars($empleado['Photo']); ?>" alt="Employee Photo">
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>




