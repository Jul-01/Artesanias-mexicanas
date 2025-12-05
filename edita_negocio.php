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

<style>
  body {
    background: linear-gradient(to right, #ff7e5f, #feb47b); /* Fondo degradado */

  }

  .card {
    width: 400px; /* Ancho del formulario */
    margin: auto;
    margin-bottom:50%;
    margin-top:50%;
  }
</style>

<body>

<div class="container-fluid mt-12 bg-dark flex">
    <div class="contenedor">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <img src="../img/logo.svg" alt="Logo de la empresa" style="width: 100px;">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
             <!-- Botón Hamburguesa para dispositivos móviles -->
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <!-- Elementos de Navegación -->
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a class="nav-link text-white" href="../index.html">Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="about_us.html">Sobre Nosotros</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contáctanos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="inicio_sesion.php">Mi cuenta</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav> 
    </header>  
    <div class="contenido">
    <div class="text-center">
        <h1 class="mb-4">Que gusto verte de nuevo</h1>
        <h2 class="mb-5">A descubrir nuevos Horizontes</h2>
        
    </div>
    </div>
</div>
</div>

<section class="edita">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Editar Negocio</h2>
            <form action="edita_negocio.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="id_negocio" class="form-label">ID del Negocio</label>
                    <input type="text" class="form-control" id="id_negocio" name="id_negocio" required>
                </div>
                <div class="mb-3">
                    <label for="nom_negocio" class="form-label">Nombre del Negocio</label>
                    <input type="text" class="form-control" id="nom_negocio" name="nom_negocio" required>
                </div>
                <div class="mb-3">
                    <label for="desc_negocio" class="form-label">Descripción del negocio</label>
                    <input type="text" class="form-control" id="desc_negocio" name="desc_negocio" required>
                </div>
                <div class="mb-3">
                    <label for="ruta_logo" class="form-label">Logo</label>
                    <input type="file" class="form-control" id="ruta_logo" name="ruta_logo" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once '../database.php';

$mensaje_editado = ""; // Variable para almacenar el estado del mensaje de edición

if (isset($_POST["id_negocio"], $_POST["nom_negocio"], $_POST["desc_negocio"])) {
    $id_negocio = $_POST["id_negocio"];
    $nom_negocio = $_POST["nom_negocio"];
    $desc_negocio = $_POST["desc_negocio"];

    // Verificar si se subió un nuevo logo
    if ($_FILES['ruta_logo']['error'] === UPLOAD_ERR_OK) {
        $ruta_logo_temporal = $_FILES['ruta_logo']['tmp_name'];
        $ruta_logo_destino = 'ruta_de_destino/'.$_FILES['ruta_logo']['name'];
        move_uploaded_file($ruta_logo_temporal, $ruta_logo_destino);

        // Actualizar la ruta del logo en la base de datos
        $sql_update_logo = "UPDATE negocio SET ruta_logo = ? WHERE id_negocio = ?";
        $statement_update_logo = $conexion->prepare($sql_update_logo);
        $statement_update_logo->bind_param('si', $ruta_logo_destino, $id_negocio);
        $statement_update_logo->execute();
    }

    // Actualizar los demás datos del negocio
    $sql_update_data = "UPDATE negocio SET nom_negocio = ?, desc_negocio = ? WHERE id_negocio = ?";
    $statement_update_data = $conexion->prepare($sql_update_data);
    $statement_update_data->bind_param('ssi', $nom_negocio, $desc_negocio, $id_negocio);
    if ($statement_update_data->execute()) {
        $mensaje_editado = "true"; // Establecer el mensaje de edición en PHP
        echo '<script>alert("Información de negocio editado correctamente.");</script>';
    } else {
        echo "Error al editar el negocio en la base de datos: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
</section>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


</body>

</html>
