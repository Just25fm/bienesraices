<?php

function conectarDB() : mysqli {

  $db_user = $_ENV['DB_USER'];
  $db_password = $_ENV['DB_PASSWORD'];
  $puerto = 26610;
  $db = new mysqli('biencesraices-juansteeven2900-b11e.b.aivencloud.com', $db_user, $db_password, 'bienesraices_crud', $puerto);
  //$db = new mysqli('localhost', 'root', 'root', 'bienesraices_crud');

  if(!$db) {
    echo "Error, no se pudo conectar";
    exit;
  }

  return $db;
}