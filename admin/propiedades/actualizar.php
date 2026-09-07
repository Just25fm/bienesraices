<?php

use App\Propiedad;

require '../../includes/app.php';
estaAutenticado();

// Validar por ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header('Location: /admin');
}

// Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);

//echo $consulta;

// Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Arreglo con mensaje de errores
$errores = Propiedad::getErrores();

// Ejecutar el código cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  // Asignar los atributos
  $args = $_POST['propiedad'];
  $propiedad->sincronizar($args);
  
  $errores = $propiedad->validar();

  if (empty($errores)) {

    // /** Subida de archivos */
    if (!is_dir(CARPETA_IMAGENES)) {
      mkdir(CARPETA_IMAGENES);
    }

    $nombreImagen = '';

    // Verificar que se ha agregado nueva imagen
    if ($imagen['name']) {
      // Eliminar imagen previa
      unlink(CARPETA_IMAGENES . $propiedad->imagen);

      // Generar nombre único
      $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

      // Subir la imagen
      move_uploaded_file($imagen['tmp_name'], CARPETA_IMAGENES . $nombreImagen);
    } else {
      $nombreImagen = $propiedad->imagen;
    }



    // Insertar en la base de datos
    $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = '{$precio}', imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = {$estacionamiento}, vendedorId = {$vendedorId} WHERE id = {$id}";

    //echo $query;

    $insertado = mysqli_query($db, $query);

    if ($insertado) {
      //Redireccionar al usuario
      header('Location: /admin?resultado=2');
    }
  }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Actualizar Propiedad</h1>

  <a href="/admin" class="boton boton-verde">Volver</a>

  <?php foreach ($errores as $error): ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST" enctype="multipart/form-data">
    <?php include '../../includes/templates/formulario_propiedades.php'; ?>

    <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
  </form>
</main>

<?php
incluirTemplate('footer');
?>