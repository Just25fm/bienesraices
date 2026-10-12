<?php

namespace App;

class Vendedor extends ActiveRecord{

  protected static $tabla = 'vendedores';
  protected static $entidad = 'Vendedor';
  protected static $columnasDB = [
    'id',
    'nombre',
    'apellido',
    'telefono',
    'email'
  ];

  public $id;
  public $nombre;
  public $apellido;
  public $telefono;
  public $email;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->telefono = !empty($args['telefono']) ? $args['telefono'] : null;
    $this->email = !empty($args['email']) ? $args['email'] : null;
    // $this->telefono = $args['telefono'] ?? null;
    // $this->email = $args['email'] ?? null;
  }

  public function validar()
  {
    $vendedores = Vendedor::all();

    //debuguear($vendedores);
    if (!$this->nombre) {
      self::$errores[] = "El nombre es obligatorio";
    }
    if (!$this->apellido) {
      self::$errores[] = "El apellido es obligatorio";
    }

    foreach ($vendedores as $vendedor) {
      if (!is_null($this->telefono) && $this->telefono === $vendedor->telefono) {
        self::$errores[] = "El teléfono ya está registrado";
      }
      if (!is_null($this->email) && $this->email === $vendedor->email) {
        self::$errores[] = "El email ya está registrado";
      }
    }

    if (!is_null($this->telefono) && !preg_match('/^[0-9]{10}$/', $this->telefono)) {
      self::$errores[] = "El teléfono debe tener exactamente 10 dígitos";
    }

    if (!is_null($this->email) && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      self::$errores[] = "El formato del email no es válido";
    }
    
    return self::$errores;
  }
}

