<?php
// Incluir conexión a la base de datos
include 'db_connection.php';

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
    <title>List Employees</title>
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
                
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                <td data-label="Id"><?php echo $row['ID']; ?></td>    
                <td data-label="Name"><?php echo $row['name']; ?></td>
                <td data-label="Lastname"><?php echo $row['lastname']; ?></td>
                <td data-label="Email"><?php echo $row['email']; ?></td>
                <td data-label="Document"><?php echo $row['identity_document']; ?></td>
                <td data-label="Address"><?php echo $row['Address']; ?></td>
                <td data-label="Phone"><?php echo $row['Telephone']; ?></td>
                <td data-label="Photo"><?php echo $row['Photo']; ?></td> 
                </tr>
            <?php } ?>
        </table>
        </div>

        <!-- Botón para volver al inicio -->
        <br><br>
        <a href="index.php">
            <button>Volver al Inicio</button>
        </a>

    </div>
</body>
</html>

