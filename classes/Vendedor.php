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
    $this->telefono = $args['telefono'] ?? null;
    $this->email = $args['email'] ?? null;
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
      if ($this->telefono === $vendedor->telefono) {
        self::$errores[] = "El teléfono ya está registrado";
      }
      if ($this->email === $vendedor->email) {
        self::$errores[] = "El email ya está registrado";
      }
    }
    
    return self::$errores;
  }
}

