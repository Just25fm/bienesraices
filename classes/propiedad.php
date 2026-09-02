<?php
namespace App;

class Propiedad{

    // Base de Datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 
    'estacionamiento', 'creado', 'vendedorId'];

    // Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public static function setDB($database) {
        self::$db = $database;
    }

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar() {
        // Sanitizat los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = "INSERT INTO propiedades (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')"; 

        $resultado = self::$db->query($query);

        debuguear($resultado);
    }

    //
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }
        if(!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }
        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "Debes añadir una descripción y debe de tener al menos 50 caracteres";
        }
        if(!$this->habitaciones) {
            self::$errores[] = "Debes añadir el número de habitaciones";
        }
        if(!$this->wc) {
            self::$errores[] = "Debes añadir el número de baños";
        }
        if(!$this->estacionamiento) {
            self::$errores[] = "Debes añadir el número de estacionamientos";
        }
        if(!$this->vendedorId) {
            self::$errores[] = "Debes añadir un vendedor";
        }

        // if(!$this->imagen) {
        //     self::$errores[] = "Debes añadir una imagen";
        // }

        // // Validar por tamaño (1 MB máximo)
        // $medida = 1000 * 1000;
        // if ($this->imagen['size'] > $medida) {
        //     $errores[] = "El la imagen es muy pesada";
        // }

        return self::$errores;
    }

}