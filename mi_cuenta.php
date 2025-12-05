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

<!-- estilos -->
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

    .btn-container {
    position: fixed;
    top: 50%;
    right: 20px; /* ajusta este valor según sea necesario */
    transform: translateY(-50%);
  }

  .btn-primary {    
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
  }

  .btn-primary:hover {
    background-color: darkgreen;
  }
  </style>

      <!-- Estilos adicionales -->
      <style>
        /* Agrega esta regla para redondear las esquinas de las imágenes */
        img {
            border-radius: 8px; /* Radio de borde */
            margin-right: 10px; /* Agrega un margen a la derecha de la imagen */
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


<section class="cuenta">
  <div class="container">
    
<!--   Obtención de los resultados -->

<?php 

if (isset($_POST["nickname"])){
  $nickname = $_POST["nickname"];
  $password_us = $_POST["password_us"];

  include_once '../database.php';
// Consulta SQL para validar el inicio de sesión y la activación de la cuenta
$sql = "SELECT * FROM usuario WHERE nickname_us = ? AND password_us = ? AND activo_us = 1";

// Preparar la sentencia con consulta preparada
$stmt = $conexion->prepare($sql);

// Vincular parámetros
$stmt->bind_param("ss", $nickname, $password_us);

// Ejecutar la consulta
$stmt->execute();

// Obtener el resultado
$result = $stmt->get_result();

// Verificar si se encontró un usuario activo
if ($result->num_rows > 0) {
  // Obtener los datos del usuario de la consulta
  $row = $result->fetch_assoc();

  // Guardar los datos en variables
  $id_usuario = $row['id_usuario'];
  $nombre_usuario = $row['nombre_us'];
  $nickname_usuario = $row['nickname_us'];
  $email_usuario = $row['email_us'];
  $rol = $row['rol_us'];

  echo '
  
  <div class="container">
    <div class="text-center">
        <h1 class="mb-4">Bienvenid@ '.$nickname.'</h1>
        
        <div class="datos-usuario">
            <h3><strong>Iniciemos esta genial experiencia '.$nombre_usuario.'</strong></h3>
            <p><strong>Cuentanos un poco de tu negocio </strong> '.$nombre_usuario.'</p>
        </div>
    </div>
</div>

  
  ';

/* VALIDADOR DE POSESIÓN DE NEGOCIO */

$query = "SELECT id_negocio FROM detalle WHERE id_usuario=$id_usuario";
$resultado = mysqli_query($conexion, $query); 

if($resultado && mysqli_num_rows($resultado) > 0){ 
  
/*  MUESTRA NEGOCIOS ASOCIADOS AL USUARIO EN CASO DE QUE LOS TENGA */

  $fila = mysqli_fetch_assoc($resultado);

  // Verificar si se obtuvo la fila correctamente
  if ($fila) {
      // Guardar el valor de id_negocio en una variable
      $id_negocio = $fila['id_negocio'];
      
      ?> 
      
      <!-- Tabla de Negocios -->
<div class="container mt-5">
    <h1 class="text-center">Negocio</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre del Negocio</th>
                <th scope="col">Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once '../database.php';

            // Obtener negocios de la base de datos
          $query = "SELECT n.* 
          FROM negocio n
          JOIN detalle d ON n.id_negocio = d.id_negocio
          WHERE d.id_usuario = $id_usuario";

          // Ejecutar la consulta SQL
          $result = mysqli_query($conexion, $query);
          

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_negocio"] . "</td>"; // Nombre del negocio
                    echo "<td><img src='" . $row["ruta_logo"] . "' /></td>"; // Imagen en el primer lugar
                    echo "<td>" . $row["nom_negocio"] . "</td>"; // Nombre del negocio
                    echo "<td>" . $row["desc_negocio"] . "</td>"; // Descripción en el último lugar
                    echo "</tr>";
                }
                
            } else {
                echo "<tr><td colspan='3'>No hay negocios registrados</td></tr>";
            }
           
            ?>
        </tbody>
    </table>

    <button class="btn btn-primary"><a  style="color:white;" href="../galeria-dinamica-master/index.php">Mi catálogo</a></button>
    <button class="btn btn-primary"><a  style="color:white;" href="edita_negocio.php">Editar</a></button>
    <button class="btn btn-primary"><a  style="color:white;" href="baja_negocio.php">Borrar</a></button>

</div>              
      
      
      <?php

      // Puedes usar $id_negocio como necesites aquí
  } else {
      // Si no se obtuvieron filas, id_negocio no está disponible
      echo "No se encontró id_negocio para el usuario con id_usuario = $id_usuario";
  }

  /* ------------------------FIN DE MUESTRA NEGOCIOS------------------------------- */


} else {

?>

<!-- FORMULARIO DE ALTA NEGOCIO -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Crea tu Negocio </h2>
            <form action="mi_cuenta.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom_negocio" class="form-label">Nombre del Negocio</label>
                    <input type="text" class="form-control" id="nom_negocio" name="nom_negocio" required>
                </div>
                <div class="mb-3">
                    <label for="desc_negocio" class="form-label">Descripción del negocio</label>
                    <input type="text" class="form-control" id="desc_negocio" name="desc_negocio" required>
                </div>
                <div class="mb-3">
                    <label for="my-input">Seleccione imagen del logo</label>
                    <input id="my-input" class="form-control" type="file" name="imagen" required>
                </div>

                                <?php if(isset($mensaje)){ ?>
                                    <div class="alert alert-<?php echo $tipoMensaje; ?> alert-dismissible fade show" role="alert">
                                        <strong><?php echo $mensaje; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>

                                <input type="hidden" name="nickname" value="<?php echo htmlspecialchars($nickname); ?>">
                                <input type="hidden" name="password_us" value="<?php echo htmlspecialchars($password_us); ?>">

                                <button type="submit" name="Guardar" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php


//FUNCIÓN DE GUARDADO DE LA INFORMACIÓN DE LOS NEGOCIOS

if (isset($_POST["nom_negocio"])) { 

    $nom_negocio = $_POST["nom_negocio"];
    $desc_negocio = $_POST["desc_negocio"];
    $ruta_temporal = $_FILES["imagen"]["name"];
    $ruta_destino = "img_negocio/" . $ruta_temporal;
    // Aquí deberías obtener la ruta de la imagen subida, pero parece que no estás utilizando esta funcionalidad en este momento

    $sql = "INSERT INTO negocio (nom_negocio, desc_negocio, ruta_logo) VALUES (?, ?, ?)";
    $statement = $conexion->prepare($sql);
    $statement->bind_param('sss', $nom_negocio, $desc_negocio, $ruta_destino);
    if ($statement->execute()) {

/*      CONEXIÓN DE NEGOCIO CON USUARIO */
// Consulta para obtener el id_negocio
$sql_select = "SELECT id_negocio FROM negocio WHERE nom_negocio = ?";
$statement_select = $conexion->prepare($sql_select);
$statement_select->bind_param('s', $nom_negocio);
$statement_select->execute();
$statement_select->bind_result($id_negocio);
$statement_select->fetch(); // Obtener el valor de id_negocio
$statement_select->close(); // Cerrar el statement

// Consulta de inserción en la tabla detalle
$sql_insert = "INSERT INTO detalle (id_negocio, id_usuario) VALUES (?,?)";
$statement_insert = $conexion->prepare($sql_insert);
$statement_insert->bind_param('ss', $id_negocio, $id_usuario);

if ($statement_insert->execute()) {
    $mensaje_guardado = "true"; // Establecer el mensaje de guardado en PHP
    echo '<script>alert("Insertado de negocio exitoso, vuelva a acceder a su cuenta para actualizar los datos");</script>';   
    exit;
} else {
    echo "Error al insertar el negocio en la tabla detalle: " . $conexion->error;
}


/*    -------------FIN CONEXIÓN------------------------
 */
    } else {
        echo "Error al insertar el negocio en la base de datos: " . $conexion->error;
    }

}

}


/* CIERRE DE USUARIO ACTIVO */
}

}
  // Cerrar la conexión
  $conexion->close();



?>
  </div>
</section>




<!-- CARGA DINÁMICA DE FOOTER -->
<div id="footer"></div>
<script>
  fetch('../footer.html')
    .then(response => response.text())
    .then(html => document.getElementById('footer').innerHTML = html);
</script>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


</body>

</html>
