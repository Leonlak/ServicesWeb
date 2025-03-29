<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'admin', 'services_web');


    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}