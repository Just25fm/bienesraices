<?php

use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

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
  
  // Validación
  $errores = $propiedad->validar();

  // Subida de archivos
  // Generar nombre único
  $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

  if ($_FILES['propiedad']['tmp_name']['imagen']) {
    $manager = new Image(Driver::class);
    $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
    $propiedad->setImagen($nombreImagen);
  }

  if (empty($errores)) {

    // Almacenar la imagen
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
      $imagen->save(CARPETA_IMAGENES . $nombreImagen);
    }

    $propiedad->guardar();

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