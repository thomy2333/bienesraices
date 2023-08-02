<?php

use App\Propiedad;

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

    // echo "<pre>";
    // var_dump($propiedad);
    // echo "</pre>";

    //consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // arreglo de mensaje de errores
    $errores = [];

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // echo "<pre>";
        // var_dump($_POST); nos trae la info cuando mandamos ina info tipo post
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES); nos permite ver el contenido de los archivos
        // echo "</pre>";

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string( $db, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
        $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor'] );
        $creado = mysqli_real_escape_string( $db, date('Y/m/d') );

        //asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        if(!$titulo){
            $errores[] = "Debes añadir un titulo";
        }
        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }
        if( strlen($descripcion) < 50 ){
            $errores[] = "La descripcion es obligatoria y tiene que tener al menos 50 caracteres";
        }
        if(!$habitaciones){
            $errores[] = "El numero de habitaciones es obligatorio";
        }
        if(!$wc){
            $errores[] = "El numero de baños es obligatorio";
        }
        if(!$estacionamiento){
            $errores[] = "El numero de estacionamiento es obligatorio";
        }
        if(!$vendedorId){
            $errores[] = "Elige un vendedor";
        }
        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        //revisar el arreglo de errores este vacio
        if(empty($errores)){

            //SUBIDA DE ARCHIVOS

            //crear la carpeta
            $carpetaImagenes = '../../imagenes/';
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            //eliminar imagen previa
            if($imagen['name']){
                unlink($carpetaImagenes . $propiedad['imagen']);

                //generar un nombre unico
                $nombreImagen = md5( uniqid( rand(), true)) .  ".jpg";

                //subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }else{
                $nombreImagen =  $propiedad['imagen'];
            }

            //insertar en la base de datos
            $query = " UPDATE propiedades SET titulo = '$titulo', precio = '$precio', imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = '$estacionamiento', vendedores_id = $vendedorId WHERE id = $id  ";

            //echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //redireccionar al usuario
                header('Location: /admin?resultado=2');
            }
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