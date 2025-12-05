<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>

<!-- estilos -->
<style>
    body {
      background: linear-gradient(to right, #ff7e5f, #feb47b); /* Fondo degradado */
      margin: auto;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      width: 400px; /* Ancho del formulario */
      margin: auto;
      margin-bottom:50%;
      margin-top:50%;
    }
</style>

<?php
// Verificar si se han recibido los parámetros necesarios
if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])) {
    // Asignar los valores de $_GET a variables
    $email = $_GET['email'];
    $hash = $_GET['hash'];
    
    include_once "../database.php";
    
    // Obtener el correo electrónico y el hash asociados al token
    $statement = $conexion->prepare("SELECT email_us, hash_ FROM usuario WHERE email_us = :email AND hash_ = :hash AND activo_us = 0");
    $statement->bindParam(':email', $email);
    $statement->bindParam(':hash', $hash);
    $statement->execute();
    
    // Verificar si se encontró una coincidencia
    $match = $statement->rowCount();
    
    if($match > 0) {
        // Si hay una coincidencia, activar la cuenta
        $statement = $conexion->prepare("UPDATE usuario SET activo_us = 1 WHERE email_us = :email AND hash_ = :hash AND activo_us = 0");
        $statement->bindParam(':email', $email);
        $statement->bindParam(':hash', $hash);
        $statement->execute();
        
        echo '<div class="statusmsg">Tu cuenta ha sido activada, ya puedes iniciar sesión.</div>';
    } else {
        // Si no hay coincidencias, mostrar un mensaje de error
        echo '<div class="statusmsg">La URL es inválida o ya has activado tu cuenta.</div>';
    }
} else {
    // Si no se han recibido los parámetros necesarios, mostrar un mensaje de error
    echo '<div class="statusmsg">Intento inválido, por favor revisa el mensaje que enviamos por correo electrónico.</div>';
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>