<?php

session_start();

// Eliminar la sesión
$_SESSION = [];

// Redirigir al usuario a la página de inicio
header('Location: /');

