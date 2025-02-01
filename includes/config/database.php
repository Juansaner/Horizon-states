<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Cargar Composer

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

function conectarDB() : mysqli {
    $db = new mysqli($_ENV['DB_HOST'], 
    $_ENV['DB_USER'], 
    $_ENV['DB_PASSWORD'], 
    $_ENV['DB_DBNAME']);

    if(!$db) {
        echo 'Error no se pudo conectar: ' . mysqli_connect_error();
        exit;
    } 

    return $db;
}

?>