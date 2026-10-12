<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

// Validar por ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header('Location: /admin');
}

// Obtener los datos del vendedor
$vendedor = Vendedor::find($id);

$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  //debuguear($_POST);
  // Asignar los atributos
  $args = $_POST['vendedor'];

  // 1. Validar si existen cambios reales
  $hayCambios = false;

  foreach ($args as $key => $value) {
    // Normalizamos el valor ingresado: si es string vacío, lo tratamos como null
    $valorIngresado = $value === '' ? null : $value;

    // Comparamos el valor del formulario con el valor actual en la base de datos
    if ($vendedor->$key !== $valorIngresado) {
      $hayCambios = true;
      break; // Al encontrar el primer cambio, detenemos el ciclo
    }
  }

  // 2. Si no hubo cambios, redirigimos inmediatamente con el mensaje
  if (!$hayCambios) {
    // Puedes definir la alerta directo en la sesión para evitar que 
    // se le concatene la palabra "Vendedor" al inicio del mensaje
    $_SESSION['alerta'] = [
      'mensaje' => 'No se realizó ningún cambio al vendedor ' . $vendedor->nombre . ' ' . $vendedor->apellido,
      'tipo' => 'advertencia' // O usa 'error' / 'advertencia' dependiendo de tus estilos CSS
    ];
    header('Location: /admin');
    exit;
  }

  // 3. Si SÍ hay cambios, el flujo continúa normal:
  // Sincronizar objeto en memoria con lo que el usuario escribio
  $vendedor->sincronizar($args);

  // Validación
  $errores = $vendedor->validar();

  if (empty($errores)) {
    $vendedor->guardar();
  }
}

incluirTemplate('header');

?>

<main class="contenedor seccion">
  <h1>Actualizar Vendedor</h1>

  <a href="/admin" class="boton boton-verde">Volver</a>

  <?php foreach ($errores as $error): ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST">
    <?php include '../../includes/templates/formulario_vendedores.php'; ?>


    <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">
  </form>
</main>

<?php
incluirTemplate('footer');
?>