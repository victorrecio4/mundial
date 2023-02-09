<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label>Usuario<input type="text" name="usuario" id="usuario"></label><br>
        <label>Contraseña<input type="password" name="pass1" id="pass1"></label><br>
        <label>Repetir la contraseña<input type="password" name="pass2" id="pass2"></label><br>
        <input type="submit" id="boton" name="boton" value="Registrarte">
    </form>
    <?php
    require 'usuario.php';
    require 'conexionBD.php';
    $conexion=conexionBD();
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //Guardamos las 2 contraseñas en dos variables diferentes
        $pass1=$_POST['pass1'];
        $pass2=$_POST['pass2'];
        //Comprobamos si las contraseñas son iguales
        if($pass1===$pass2){
            //Guardamos el nombre de usuario en una variable
            $username=$_POST['usuario'];
            //Y creamos un Usuario con el nombre del usuario y una de las contraseñas
            $usuario = new Usuario($username, $pass1);
            //Comprobamos si el usuario ya esta registrado en el sistema
            if($usuario->comprobarUsuario($conexion, $username)){
                //Si no esta registrado registramos al usuario y abrimos el login 
                $usuario->registrarUsuario($conexion, $username, $pass1);
                header('Location: login.php');
            }
            else{//Si el usuairo ya esta registrado salta el ERROR
                echo '<p>Error, el usuario introducido ya esta registrado/p>';
            }
        }else{//Si las contraseñas no son iguales salta el ERROR
            echo '<p>ERROR, las contraseñas no pueden ser diferentes</p>';
        }
    }

    ?>
</body>
</html>