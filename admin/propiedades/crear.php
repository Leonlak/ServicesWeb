<?php

require '../../includes/funciones.php';
$auth = estaAutenticado();


if(!$auth) {
    header('Location: /');
}
// bases de datos
require '../../includes/config/database.php';
$db = conectarDB();

$consulta = "SELECT * FROM bienesraices_crud.vendedores";
$resultado = mysqli_query($db, $consulta);


//Arreglo con mensajes de errores
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
//$habitaciones = '';
//$wc = '';
//$estacionamiento = '';
//$vendedorId = '';

//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";

    //echo "<pre>";
    //var_dump($_FILES);
    //echo "</pre>";

    //exit;

$titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
$precio = mysqli_real_escape_string ($db, $_POST['precio']);
$descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
//$habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
//$wc = mysqli_real_escape_string($db, $_POST['wc']);
//$estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
//$vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
//$creado = date('y/m/d');

//Asignar files hacia una variable
$imagen = $_FILES['imagen'];




if (!$titulo) {
    $errores[] = "Debes añadir un titulo";

}
if (!$precio) {
    $errores[] = "Debes añadir un precio";

}

if (strlen($descripcion) <= 50) {
    $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";

}

//if (!$habitaciones) {
    //$errores[] = "El numero de habitaciones es obligatorio";

//}

//if (!$wc) {
   // $errores[] = "El numero de baños es obligatorio";

//}

//if (!$estacionamiento) {
  //  $errores[] = "El numero de lugares de Estacionamiento es obligatorio";


//}

//if (!$vendedorId) {
  //  $errores[] = "Elige un vendedor";

//}

if (!$imagen['name'] || $imagen['error']) {
    $errores[] = "La imagen es Obligatoria";
    
}

$medida = 1000 * 1000;

if ($imagen['size'] > $medida) {
    $errores[] = 'La imagen es muy pesada';
}

//echo "<pre>";
//var_dump($errores);
//echo "</pre>";

//Revisar que el array de errores este vacio
if (empty($errores)) {

/**Subida de archivos */

//crear carpeta
$carpetaImagenes = '../../imagenes/';

if (!is_dir($carpetaImagenes)) {
    mkdir($carpetaImagenes);
}

//Generar un nombre unico
$nombreImagen = md5(uniqid( rand(), true) ) . ".jpg";

//subir imagen
move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen ); 


    

// insertar en la base de datos

$query = "INSERT INTO `bienesraices_crud`.`propiedades` (`titulo`, `precio`, `imagen`, `descripcion`) VALUES ('$titulo',
'$precio', '$nombreImagen', '$descripcion')";

//, '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId '
//, `habitaciones`, `wc`, `estacionamiento`, `creado`, `vendedor_Id`
//echo $query;

$resultado = mysqli_query($db, $query);

if($resultado) {
   //Redireccionar al usuario

   header('Location: /admin?resultado=1');
}

}




}




 incluirTemplate('header');
 ?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
        <?php echo $error; ?>
        </div>
        
        <?php endforeach; ?>


        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                
                <label for="descripcion">Descripcion:</label>
                <textarea  id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>"></textarea>
            </fieldset>

        <!--    <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">--Seleccione --</option>
                  <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?>  value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>

                   <?php endwhile; ?> 
                </select>
            </fieldset>-->
            <input type="submit" value="Crear Propiedad"  class="boton boton-verde">
        </form>
    </main>

<?php

incluirTemplate('footer');
 ?>