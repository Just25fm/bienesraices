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
    $this->id = $args['id'] ?? '';
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->telefono = $args['telefono'] ?? '';
    $this->email = $args['email'] ?? '';
  }
}

