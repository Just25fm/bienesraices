<?php

namespace App;

class ActiveRecord {
  
  // Base de Datos
  protected static $db;
  protected static $columnasDB = [];
  protected static $tabla = '';
  protected static $entidad = '';

  // Errores
  protected static $errores = [];

  public $id;

  public static function setDB($database)
  {
    self::$db = $database;
  }

  public function guardar()
  {
    if (!is_null($this->id)) {
      // Actualizar
      $this->actualizar();
    } else {
      // Crear
      $this->crear();
    }
  }

  public function alertas($mensaje, $tipo)
  {
    $_SESSION['alerta'] = [
      'mensaje' => static::$entidad . ' ' . $mensaje,
      'tipo' => $tipo
    ];
  }

  public function crear()
  {
    // Sanitizat los datos
    $atributos = $this->sanitizarAtributos();

    // Insertar en la base de datos
    $query = "INSERT INTO " . static::$tabla . " (";
    $query .= join(', ', array_keys($atributos));
    $query .= ") VALUES ('";
    $query .= join("', '", array_values($atributos));
    $query .= "')";

    $resultado = self::$db->query($query);

    if ($resultado) {
      //Redireccionar al usuario
      $this->alertas('Creado Correctamente', 'exito');
      header('location: /admin');
      exit;
      //header('Location: /admin?resultado=1');
    }
  }

  public function actualizar()
  {
    // Sanitizat los datos
    $atributos = $this->sanitizarAtributos();

    $valores = [];
    foreach ($atributos as $key => $value) {
      $valores[] = "{$key}='{$value}'";
    }

    $query = "UPDATE " . static::$tabla . " SET ";
    $query .= join(', ', $valores);
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1";

    $resultado = self::$db->query($query);

    if ($resultado) {
      //Redireccionar al usuario
      $this->alertas('Actualizado Correctamente', 'exito');
      header('location: /admin');
      exit;
      //header('Location: /admin?resultado=2');
    }
  }

  // Eliminar un registro
  public function eliminar()
  {
    // Eliminar la propiedad
    $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

    $resultado = self::$db->query($query);

    if ($resultado) {
      $this->borrarImagen();
      $this->alertas('Eliminado Correctamente', 'exito');
      //debuguear($_SESSION);
      header('location: /admin');
      exit;
      //debuguear($_SESSION);
      //header('location: /admin?resultado=3');
    }
  }

  // Identificar y unir los atributos de la BD
  public function atributos()
  {
    $atributos = [];
    foreach (static::$columnasDB as $columna) {
      if ($columna === 'id')
        continue;
      $atributos[$columna] = $this->$columna;
    }
    return $atributos;
  }

  public function sanitizarAtributos()
  {
    $atributos = $this->atributos();
    $sanitizado = [];

    foreach ($atributos as $key => $value) {
      $sanitizado[$key] = self::$db->escape_string($value);
    }

    return $sanitizado;
  }

  public static function getErrores()
  {
    return static::$errores;
  }

  public function validar()
  {
    static::$errores = [];
    return static::$errores;
  }

  public function setImagen($imagen)
  {

    // Elimina la imagen previa
    if (!is_null($this->id)) {
      $this->borrarImagen();
    }

    // Asignar al atributo de imagen el nombre de la imagen
    if ($imagen) {
      $this->imagen = $imagen;
    }
  }

  public function borrarImagen()
  {
    // Comprobar si el objeto actual tiene la propiedad 'imagen'
    if (property_exists($this, 'imagen')) {
      // Comprobar si existe el archivo
      $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
      if ($existeArchivo) {
        unlink(CARPETA_IMAGENES . $this->imagen);
      }
    }
    
  }

  public static function all()
  {
    $query = "SELECT * FROM " . static::$tabla;

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public static function find($id)
  {
    $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }

  public static function consultarSQL($query)
  {
    // Consultar la base de datos
    $resultado = self::$db->query($query);

    // Iterar los resultados
    $array = [];
    while ($registro = $resultado->fetch_assoc()) {
      $array[] = static::crearObjeto($registro);
    }

    // Liberar la memoria
    $resultado->free();

    // Retornar los resultados
    return $array;
  }

  protected static function crearObjeto($registro)
  {
    $objeto = new static;

    foreach ($registro as $key => $value) {
      if (property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
  }

  // Sincroniza el objeto en memoria con los cambios realizados por el usuario
  public function sincronizar($args = [])
  {
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }
}