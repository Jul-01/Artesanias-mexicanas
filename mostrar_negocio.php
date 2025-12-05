
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Negocio</title>

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

  .table {
            background-color: #71B070; /* Cambia el fondo de la tabla */
            color: white; /* Color del texto */
            border-radius: 10px; /* Redondea las esquinas de la tabla */
            border: 4px solid white; /* Grosor del borde externo */
        }

        .table th,
        .table td {
            border-right: 4px solid white; /* Grosor del borde interno */
            border-left: 4px solid white; /* Grosor del borde interno */
        }

        .table img {
            max-width: 100px; /* Ancho máximo de las imágenes */
            display: block; /* Hace que las imágenes se muestren como bloques */
        }

        /* Agrega líneas verticales entre las columnas */
        .table th,
        .table td {
            border-right: 4px solid white;
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
<!-- Tabla de Negocios -->
<div class="container mt-5">
    <h1 class="text-center">Negocios</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre del Negocio</th>
                <th scope="col">Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once '../database.php';

            // Obtener negocios de la base de datos
          $query = "SELECT *
          FROM negocio";

          // Ejecutar la consulta SQL
          $result = mysqli_query($conexion, $query);
          

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='" . $row["ruta_logo"] . "' /></td>"; // Imagen en el primer lugar
                    echo "<td>" . $row["nom_negocio"] . "</td>"; // Nombre del negocio
                    echo "<td>" . $row["desc_negocio"] . "</td>"; // Descripción en el último lugar
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay negocios registrados</td></tr>";
            }
            $conexion->close();
            ?>
        </tbody>
    </table>
</div>
</section>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


</body>

</html>
