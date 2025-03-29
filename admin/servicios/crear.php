

<?php
require '../../includes/funciones.php';
//$auth = estaAutenticado();


if(!$auth) {
    header('Location: /');
}

//Validar la URL por ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);


if(!$id) {
    header('Locattion: /admin');
}


// bases de datos
require '../../includes/config/database.php';
$db = conectarDB();

//Obtener los datos de la propiedad
$consulta = "SELECT * FROM services_web.servicios WHERE id = $id";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);




//Consulta para obtener los vendedores
$consulta = "SELECT * FROM services_web.desarrollador";
$resultado = mysqli_query($db, $consulta);


//Arreglo con mensajes de errores
$errores = [];

$nombre = $servicio['nombre'];
$precio = $servicio['precio'];
$descripcion = $servicio['descripcion'];
$dificultad = $servicio['dificultad'];
$fechai = $servicio['fechai'];
$fechaf = $servicio['fechaf'];
$desarrolladorId = $servicio['desarrollador_Id'];
$imagenServicio = $servicio['imagen'];

//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){



$nombre = mysqli_real_escape_string( $db, $_POST['nombre']);
$precio = mysqli_real_escape_string ($db, $_POST['precio']);
$descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
$dificultad = mysqli_real_escape_string($db, $_POST['dificultad']);
$fechai = mysqli_real_escape_string($db, $_POST['fechai']);
$fechaf = mysqli_real_escape_string($db, $_POST['fechaf']);
$desarrolladorId = mysqli_real_escape_string($db, $_POST['desarrollador']);
$creado = date('y/m/d');

//Asignar files hacia una variable
$imagen = $_FILES['imagen'];




if (!$nombre) {
    $errores[] = "Debes añadir un titulo";

}
if (!$precio) {
    $errores[] = "Debes añadir un precio";

}

if (strlen($descripcion) < 50) {
    $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";

}

if (!$dificultad) {
    $errores[] = "El numero de dificultad es obligatorio";

}

if (!$fechai) {
    $errores[] = "la fecha de inicio es obligatorio";

}

if (!$fechaf) {
    $errores[] = "la fecha final es obligatorio";


}

if (!$desarrolladorId) {
    $errores[] = "Elige un desarrollador";

}

//Validar por tamaño(1mb maximo)
$medida = 1000 * 1000;

if ($imagen['size'] > $medida) {
    $errores[] = 'La imagen es muy pesada';
}



//Revisar que el array de errores este vacio
if (empty($errores)) {


//crear carpeta
$carpetaImagenes = '../../imagenes/';

if (!is_dir($carpetaImagenes)) {
  mkdir($carpetaImagenes); 

  }

  $nombreImagen = '';

/**Subida de archivos */
if($imagen['name']) {

 //Eliminar imagen previa
 unlink($carpetaImagenes . $propiedad['imagen']);

 //Generar un nombre unico
$nombreImagen = md5(uniqid( rand(), true) ) . ".jpg";

//subir imagen
move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen ); 

} else {
    $nombreImagen = $propiedad['imagen'];
}




// insertar en la base de datos
$query = "INSERT INTO `services_web`.`servicios` SET `nombre` = '$nombre', `precio` = '$precio', `imagen` = '$nombreImagen', `descripcion` = '$descripcion', 
`dificultad` = '$dificultad', `fechai` = '$fechai', `fechaf` = '$fechaf', `desarrollador_Id` = '$desarrolladorId' WHERE id = $id ";



//echo $query;

$resultado = mysqli_query($db, $query);

if($resultado) {
   //Redireccionar al usuario

   header('Location: /admin?resultado=2');
}

}




}




 //incluirTemplate('header');
 ?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
        <?php echo $error; ?>
        </div>
        
        <?php endforeach; ?>


        <form class="formulario" method="POST"  enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad ?>" class="imagen-small">
                
                <label for="descripcion">Descripcion:</label>
                <textarea  id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Servicios Web</legend>

                <label for="dificultad">Dificultad:</label>
                <input type="number" id="dificultad" name="dificultad" placeholder="Ej: 3" min="1" max="9" value="<?php echo $dificultad; ?>">

                <label for="fechai">Fecha de Inicio:</label>
                <input type="date" id="fechai" name="fechai" placeholder="Ej: 3" min="1" max="9" value="<?php echo $fechai; ?>">

                <label for="estacionamiento">Fecha final:</label>
                <input type="date" id="fechaf" name="fechaf" placeholder="Ej: 3" min="1" max="9" value="<?php echo $fechaf; ?>">
            </fieldset>

            <fieldset>
                <legend>Desarrolador</legend>

                <select name="desarrollador">
                    <option value="">--Seleccione --</option>
                   <?php while($desarrollador = mysqli_fetch_assoc($resultado)): ?>
                    <option <?php echo $desarrolladorId === $desarrollador['id'] ? 'selected' : ''; ?>  value="<?php echo $desarrollador['id']; ?>"><?php echo $desarrollador['nombre'] . " " . $desarrollador['apellido']; ?></option>

                   <?php endwhile; ?>
                </select>
            </fieldset>
            <input type="submit" value="Actualizar Servicio"  class="boton boton-verde">
        </form>
    </main>

<?php

//incluirTemplate('footer');
 ?>

