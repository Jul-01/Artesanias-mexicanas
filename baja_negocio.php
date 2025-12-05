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
                    <a class="nav-link text-white" href="mostrar_negocio.php">Negocios</a>
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
            <h2 class="text-center mb-4">Baja de Negocio</h2>
            <form action="baja_negocio.php" method="POST">
                <div class="mb-3">
                    <label for="id_negocio" class="form-label">ID del Negocio</label>
                    <input type="text" class="form-control" id="id_negocio" name="id_negocio" required>
                </div>
                <button type="submit" class="btn btn-danger">Eliminar Negocio</button>
            </form>
        </div>
    </div>
</div>
<?php
include_once '../database.php';

if (isset($_POST["id_negocio"])) {
    $id_negocio = $_POST["id_negocio"];

    // Realizar la eliminación del negocio en la base de datos
    $sql = "DELETE FROM negocio WHERE id_negocio = ?";
    $statement = $conexion->prepare($sql);
    $statement->bind_param('i', $id_negocio);

    if ($statement->execute()) {
        echo "Negocio eliminado correctamente.";
    } else {
        echo "Error al eliminar el negocio: " . $conexion->error;
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
