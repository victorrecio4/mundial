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
    require 'funciones.php';
    require 'conexionBD.php';
    $conexion=conexionBD();
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //Variables para guarda las 2 contraseñas
        $pass1=$_POST['pass1'];
        $pass2=$_POST['pass2'];
        //Si las dos contraseñas son iguales
        if($pass1===$pass2){
            //Guardamos el usuario en una variable
            $usuario=$_POST['usuario'];
            //Comprobamos si este usuario esta registrado en el BD
            if(comprobarRegistro($conexion, $usuario)){
                //Si no esta registrado lo registramos y abrimos la pagina del login
                registrar($conexion, $usuario, $pass1);
                session_start();
                header('Location: login.php');
            }
            else{//Si el usuario ya esta registrado salta el ERROR
                echo '<p>Error, el usuario introducido ya esta registrado/p>';
            }
        }else{//Si las contraseñas son iguales salta el ERROR
            echo '<p>ERROR, las contraseñas no pueden ser diferentes</p>';
        }
    }

    ?>
</body>
</html>