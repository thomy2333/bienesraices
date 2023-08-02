<?php

    require '../../includes/app.php';  

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();
   
    $db= conectarDB();

    $propiedad = new Propiedad();

    //consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // arreglo de mensaje de errores
    $errores = Propiedad::getErrores();

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //crea una nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);
        
        //SUBIDA DE ARCHIVOS
    

        //generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true)) .  ".jpg";

        //setar al imagen
        //realizar un resize a la imagen con itervecion 
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }
        

        //validar
        $errores =  $propiedad->validar();      

        //revisar el arreglo de errores este vacio
        if(empty($errores)){
            //crear la carpeta para subir imagenes
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            //guarda la imagen en el servidor
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            //guardar en la base de datos
            $propiedad->crear();           
        }

    }

    incluirTemplate('header')
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
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer')
?>