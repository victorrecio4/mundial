<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="text" id="usuario" name="usuario" placeholder="Usuario">
        <input type="password" id="pass" name="pass" placeholder="Contraseña">
        <input type="submit" id="boton" name="boton" value="Iniciar Sesion"><br>
        <a href="registro.php">Si no tienes cuenta, REGISTRATE</a>
    </form>
    <?php
    require 'funciones.php';
    require 'conexionBD.php';
    //Variables
    $usuario = "";
    $pass = "";
    $conexion = conexionBD();
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //Si el usuario esta vacio salta el error
        if(empty($_POST['usuario'])){
            echo "<p>ERROR, el usuario no puede estar vacio</p>";
        }else{//Si el cuadro de texto de contraseña esta vacia salta el error
            if(empty($_POST['pass'])){
                echo "<p>ERROR, la contraseña no puede estar vacia</p>";
            }else{//Si no guardamos el usuario y la contraseña
                $usuario= $_POST['usuario'];
                $pass = $_POST['pass'];
                //Comprobamos la autentificacion del usuario 
                if (authentication($conexion, $usuario, $pass)) {
                    //Si es asi abrimos la pagina de votacion
                    header('Location: votacion.php');
                } else {//Si no es asi salta el ERROR
                    echo '<p>El nombre de usuario o la contraseña no son válidos</p>';
                }
            }
        }
    }
    ?>

    <?php
        session_start();
    ?>
</body>
</html>