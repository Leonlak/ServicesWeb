
<?php 

//Importar la conexion
require 'includes/config/database.php';
$db = conectarDB();

// crear email y password
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);



//Query para crear el usuario
$query = " INSERT INTO `bienesraices_crud`.`usuarios` (`email`, `password`) VALUES ('$email', '$passwordHash'); ";

//echo $query;




// Agregarlo a la base de datos 
mysqli_query($db, $query);


