<?php

    //conexion al base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    //autenticar el usuario
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = "El email es obligatorio o no es valido";
        }

        if(!$password){
            $errores[] = "El Password es obligatorio";
        }

        if(empty($errores)){
            
        }
    }

    //incluye el header
    require 'includes/funciones.php';    
    incluirTemplate('header')
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>     
        <form method="POST" class="formulario">
        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" require>

                <label for="password">Teléfono</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" require>
            </fieldset>

            <input type="submit" value="Iniciar Sesíon" class="boton boton-verde">
        </form>
    </main>
<?php
    incluirTemplate('footer')
?>