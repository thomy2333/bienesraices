<?php

    //incluye el header
    require 'includes/app.php';  
    $db = conectarDB();

    //autenticar el usuario
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = "El email es obligatorio o no es valido";
        }

        if(!$password){
            $errores[] = "El Password es obligatorio";
        }

        if(empty($errores)){
            //revisar si el existe usuario
            $query = "SELECT * FROM usuarios WHERE email = '$email' ";
            $resultado = mysqli_query($db, $query);

            // var_dump($resultado);
            
            if( $resultado->num_rows){ //comprobar que haya resultado en una consulta uhna base de datos
                //revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //var_dump($usuario['password']);

                //verificar si el password es corresto o no
                $auth = password_verify($password, $usuario['password']);

                if ($auth) {
                    // el usuario esta autenticado
                    session_start();

                    //llenar el arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('location: /admin');
                    
                    // echo "<pre>";
                    // var_dump($_SESSION);
                    // echo "</pre>";
                } else {
                    $errores[] = 'El password es incorrecto';
                }
            }else{
                $errores[] = 'El Usuario no existe';
            }
        }
    }

      
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