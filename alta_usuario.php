<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Amanita Sitio Web</title>

   <!--  bootstrap css -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

<!-- formulario de inicio de sesion -->

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center mb-4">Alta de Usuario</h2>
        <form action="alta_usuario.php" method="POST">
          <div class="mb-3">
            <label for="nombre_us" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombre_us" name="nombre_us" required>
          </div>
          <div class="mb-3">
            <label for="nickname_us" class="form-label">Nombre de Usuario (sin espacios) </label>
            <input type="text" class="form-control" id="nickname_us" name="nickname_us"  required>
          </div>
          <div class="mb-3">
            <label for="email_us" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email_us" name="email_us" required>
          </div>
          <div class="mb-3">
            <label for="password_us" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password_us" name="password_us" required>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </div>

<!--   Obtención de los resultados -->

<?php
include_once '../database.php';

if (isset($_POST["nombre_us"])) {
    $nombre_us = $_POST["nombre_us"];
    $password_us = $_POST["password_us"];
    $nickname_us = $_POST["nickname_us"];
    $email_us = $_POST["email_us"];
    $activo_us=1;

// Insertar datos en la tabla 'usuario'
$sql = "INSERT INTO usuario (nombre_us, password_us, nickname_us, email_us, activo_us) VALUES (?, ?, ?, ?, ?)";
$statement = $conexion->prepare($sql);
$statement->bind_param('sssss', $nombre_us, $password_us, $nickname_us, $email_us, $activo_us);
if ($statement->execute()) {
    
    // Insertar datos en la tabla 'user'
    $sql = "INSERT INTO user (id, email, password, first_name, last_name, mobile, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $statement = $conexion->prepare($sql);
    
    // Suponiendo que 'id' es autoincremental, podríamos omitirlo aquí
    $id = null;
    
    // Suponiendo que 'mobile' y 'address' son campos opcionales, podríamos usar valores por defecto
    $mobile = 0;
    $address = '';
    
    // Bind de los parámetros
    $statement->bind_param('issssis', $id, $email_us, $password_us, $nombre_us, $nickname_us, $mobile, $address);
    
    if ($statement->execute()) {
      echo '<script>alert("Usuario guardado correctamente.");</script>';
    } else {
        echo "Error al insertar usuario en la tabla 'user': " . $statement->error;
    }
} else {
    echo "Error al insertar usuario en la tabla 'usuario': " . $statement->error;
}

$conexion->close();

}
?>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


</body>

</html>