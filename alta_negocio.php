<?php
session_start(); // Iniciar sesión para utilizar variables de sesión

// Verificar si se ha enviado algún mensaje en una sesión anterior
if(isset($_SESSION['mensaje'])){
    $mensaje = $_SESSION['mensaje'];
    $tipoMensaje = $_SESSION['tipo'];
    // Eliminar el mensaje de la sesión para evitar que se muestre nuevamente
    unset($_SESSION['mensaje']);
    unset($_SESSION['tipo']);
}

// Resto del código...

if (isset($_FILES["imagen"])) {
    $imagen = $_FILES["imagen"];

    // Validar y mover el archivo de imagen a una carpeta de destino
    if ($imagen['error'] === UPLOAD_ERR_OK) {
        $ruta_logo_temporal = $imagen['tmp_name'];
        $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $nombre_archivo = uniqid() . '.' . $extension; // Generar un nombre único para el archivo
        $ruta_logo_destino = 'img_negocio/' . $nombre_archivo;
        if(move_uploaded_file($ruta_logo_temporal, $ruta_logo_destino)){
            $mensaje = "El archivo se subió correctamente.";
            $tipoMensaje = "success";
        } else {
            $mensaje = "Error al subir el archivo de imagen.";
            $tipoMensaje = "danger";
        }
    } else {
        $mensaje = "Error al subir el archivo de imagen.";
        $tipoMensaje = "danger";
    }
}

// Resto del código...

?>



<!-- Estilos -->
<style>

    .card {
      width: 400px; /* Ancho del formulario */
      margin: auto;
      margin-bottom:50%;
      margin-top:50%;      
    }

</style>

<!-- Formulario de alta de negocio -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Crea tu Negocio </h2>
            <form action="alta_negocio.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom_negocio" class="form-label">Nombre del Negocio</label>
                    <input type="text" class="form-control" id="nom_negocio" name="nom_negocio" required>
                </div>
                <div class="mb-3">
                    <label for="desc_negocio" class="form-label">Descripción del negocio</label>
                    <input type="text" class="form-control" id="desc_negocio" name="desc_negocio" required>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <h3 class="text">Subir imagen</h3>
                            <form action="subir.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="my-input">Seleccione una Imagen</label>
                                    <input id="my-input"  type="file" name="imagen">
                                </div>

                                <?php if(isset($mensaje)){ ?>
                                    <div class="alert alert-<?php echo $tipoMensaje; ?> alert-dismissible fade show" role="alert">
                                        <strong><?php echo $mensaje; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>
                                <button type="submit" name="Guardar" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--   Obtención de los resultados -->
<?php

$mensaje_guardado = ""; // Variable para almacenar el estado del mensaje de guardado

if (isset($_POST["nom_negocio"])) {
    $nom_negocio = $_POST["nom_negocio"];
    $desc_negocio = $_POST["desc_negocio"];
    // Aquí deberías obtener la ruta de la imagen subida, pero parece que no estás utilizando esta funcionalidad en este momento

    $sql = "INSERT INTO negocio (nom_negocio, desc_negocio, ruta_logo) VALUES (?, ?, ?)";
    $statement = $conexion->prepare($sql);
    $statement->bind_param('sss', $nom_negocio, $desc_negocio, $ruta_logo);
    if ($statement->execute()) {

      $sql="SELECT id_negocio FROM negocio WHERE nom_negocio=$nom_negocio";
      $id_negocio= mysqli_query($conexion, $sql); 
      $sql= "INSERT INTO detalle (id_negocio, id_usuario) VALUES (?,?)";
      $statement = $conexion->prepare($sql);
      $statement->bind_param('ss', $id_negocio, $id_usuario);

      if ($statement->execute()) {
        $mensaje_guardado = "true"; // Establecer el mensaje de guardado en PHP
        echo '<script>alert("Insertado de negocio existoso");</script>';}
        else{ echo "Error al insertar el negocio en la tabla detalle: " . $conexion->error;}

    } else {
        echo "Error al insertar el negocio en la base de datos: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>

