<?php

    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if (!$auth) {
      header('location: /');
    }
    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensaje de errores
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    // Ejecutar el código cuando se envía el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // echo "<pre>";
      // var_dump($_POST);
      // echo "</pre>";

      // echo "<pre>";
      // var_dump($_FILES);
      // echo "</pre>";
      
      $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
      $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
      $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion'] );
      $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones'] );
      $wc = mysqli_real_escape_string( $db, $_POST['wc'] );
      $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
      $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor'] );
      $creado = date('Y/m/d');

      // Asignar files hacia una variable
      $imagen = $_FILES['imagen'];

      if (!$titulo) {
        $errores[] = "Debes añadir un título";
      }
      if (!$precio) {
        $errores[] = "Debes añadir un precio";
      }
      if ( strlen( $descripcion ) < 50) {
        $errores[] = "Debes añadir una descripción y debe de tener al menos 50 caracteres";
      }
      if (!$habitaciones) {
        $errores[] = "Debes añadir el número de habitaciones";
      }
      if (!$wc) {
        $errores[] = "Debes añadir el número de baños";
      }
      if (!$estacionamiento) {
        $errores[] = "Debes añadir el número de estacionamientos";
      }
      if (!$vendedorId) {
        $errores[] = "Debes añadir un vendedor";
      }
      if (!$imagen['name'] || $imagen['error']) {
        $errores[] = "Debes añadir una imagen";
      }

      // Validar por tamaño (1 MB máximo)
      $medida = 1000 * 1000;
      if ($imagen['size'] > $medida) {
        $errores[] = "El la imagen es muy pesada";
      }

      if(empty($errores)) {

        /** Subida de archivos */

        //Crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes)) {
          mkdir($carpetaImagenes);
        }

        // Generar nombre único
        $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

        // Subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        // Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";

        //echo $query;

        $insertado = mysqli_query($db, $query);

        if ($insertado) {
          //Redireccionar al usuario
          header('Location: /admin?resultado=1');
        }
        
      }
    } 

  incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde" >Volver</a>

        <?php foreach($errores as $error): ?>
          <div class="alerta error">
            <?php echo $error; ?>
          </div>
        <?php endforeach;?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
          <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción Propiedad"><?php echo $descripcion; ?></textarea>

          </fieldset>

          <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

          </fieldset>

          <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
              <option value="" disabled selected>-- Seleccione --</option>
              <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id'];?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
              <?php endwhile; ?>
            </select>

          </fieldset>

          <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer'); 
?>