<?php
  // Importar la conexión
  require __DIR__ . '/../config/database.php';
  $db = conectarDB();

  // Consultar
  $query = "SELECT * FROM propiedades LIMIT {$limite}";

  // Obtener los resultados
  $resultado = mysqli_query($db, $query);

?>

<div class="contenedor-anuncios">
  <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">
      <!-- <img loading="lazy" src="build/img/anuncio1.jpg" alt="anuncio"> -->
      <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">
      

      <div class="contenido-anuncio">
        <h3><?php echo $propiedad['titulo']; ?></h3>
        <p><?php echo $propiedad['descripcion']; ?></p>
        <p class="precio">$<?php echo $propiedad['precio']; ?></p>

        <ul class="iconos-caracteristicas">
          <li>
            <img class="icono" src="build/img/icono_wc.svg" alt="icono wc">
            <p><?php echo $propiedad['wc']; ?></p>
          </li>
          <li>
            <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
            <p><?php echo $propiedad['estacionamiento']; ?></p>
          </li>
          <li>
            <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
            <p><?php echo $propiedad['habitaciones']; ?></p>
          </li>
        </ul>

        <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Ver Propiedad</a>
      </div> <!--.contenido-anuncio-->
    </div><!--.anuncio-->
  <?php endwhile; ?>
</div><!--.contenedor-anuncio-->

<?php
  // Cerrar la conexión
  mysqli_close($db);
?>