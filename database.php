<?php
// Datos de conexión a la base de datos
$servername = "boxuxcribnh9vox3xhlg-mysql.services.clever-cloud.com"; // Nombre del servidor
$username = "u4lohwkmpqfgjm5j"; // Nombre de usuario de la base de datos
$password = "6QaiBoLllLz1Gis9hmZO"; // Contraseña de la base de datos
$dbname = "boxuxcribnh9vox3xhlg"; // Nombre de la base de datos

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
  } 


// Cerrar conexión
/* $conn->close();
?>
 */