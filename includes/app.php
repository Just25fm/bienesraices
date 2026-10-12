<?php

// 1. Cargamos el autoloader de Composer
require __DIR__ . '/../vendor/autoload.php';

// 2. Se inicializan y se cargan las variables del archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// 3. Ahora ya se pueden requerir los archivos de la aplicación, ya que las variables de entorno están disponibles
require 'funciones.php';
require 'config/database.php';


// 4. Conectarnos a la base de datos
$db = conectarDB();

use App\ActiveRecord;

ActiveRecord::setDB($db);

