<?php

  // Conectarse a la DB
  require 'includes/config/database.php';
  $db = conectarDB();

  // Autenticar el usuario

  $errores =[];

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) );
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email) {
      $errores[] = "El email es oblogatorio o no es válido";
    }

    if(!$password) {
      $errores[] = "El password es obligatorio";
    }

    if(empty($errores)) {

      // Revisar si el usuario existe
      $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
      $resultado = mysqli_query($db, $query);

      // var_dump($resultado);

      if($resultado -> num_rows) {
        // Revisar si el password es correcto
        $usuario = mysqli_fetch_assoc($resultado);

        $auth = password_verify($password, $usuario['password']);

        if($auth) {
          // El usuario está autenticado
          session_start();

          // Llenar arreglo de la sesión
          $_SESSION['usuario'] = $usuario['email'];
          $_SESSION['login'] = true;

          header('location: /admin');
        }else {
          $errores[] = "El password es incorrecto";
        }
      }else {
        $errores[] = "El Usuario no existe";
      }
    }
  }
  
  // Incluye el headeer
  require 'includes/funciones.php';
  incluirTemplate('header');
?>

  <main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
      <div class="alerta error">
        <?php echo $error; ?>
      </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
      <fieldset>
        <legend>Email y Password</legend>
        
        <label for="email">E-mail</label>
        <input type="email" name="email" placeholder="Tu Email" id="email">

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Tu Password" id="password">
      </fieldset>

      <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
  </main>

<?php 
  incluirTemplate('footer'); 
?>