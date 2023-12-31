<?php

use App\Propiedad;
use App\Vendedor;

use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';    
    estaAutenticado();
    
    
    //Validar la url por un dia valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    //consultar para obtener los vendedores
    $vendedores = Vendedor::all();

    // arreglo de mensaje de errores
    $errores = Propiedad::getErrores();

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        //validacion
        $errores = $propiedad->validar();

        //subida de archivos

        //generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true)) .  ".jpg";

        if($_FILES['propiedad']['tmp_name']['imagen']){
            $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //revisar el arreglo de errores este vacio
        if(empty($errores)){
            if($_FILES['propiedad']['tmp_name']['imagen']){
                //almacenar la imagen
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }

            $propiedad->guardar();
        }
    }    
    incluirTemplate('header')
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>    
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php';?>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer')
?>