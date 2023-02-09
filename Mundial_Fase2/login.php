<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
</head>
<body>
    <!--Formulario para el inicio de sesion-->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="text" id="usuario" name="usuario" placeholder="Usuario">
        <input type="password" id="pass" name="pass" placeholder="Contraseña">
        <input type="submit" id="boton" name="boton" value="Iniciar Sesion"><br>
        <a href="registro.php">Si no tienes cuenta, REGISTRATE</a>
    </form>
    <?php
    require 'usuario.php';
    require 'conexionBD.php';
    //Variables
    $username = "";
    $pass = "";
    $conexion = conexionBD();
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //Si la en cuadro de texto usuario esta vacio salte el ERROR
        if(empty($_POST['usuario'])){
            echo "<p>ERROR, el usuario no puede estar vacio</p>";
        }else{
            //Si la en cuadro de texto pass esta vacio salte el ERROR
            if(empty($_POST['pass'])){
                echo "<p>ERROR, la contraseña no puede estar vacia</p>";
            }else{
                //Si las dos estan rellenadas 
                //Guardamos en las diferentes variables el nombre y la contraseña
                //Y creamos un Usuario
                $username= $_POST['usuario'];
                $pass = $_POST['pass'];
                $usuario = new Usuario($username, $pass);
                //Comprobamos si el logines correcto
                //Si es asi iniciamos la sesion y abrimos la pagina de votacion
                if ($usuario->login($conexion, $username,$pass)) {
                    session_start();
                    $_SESSION['usuario'] = $usuario;
                    header('Location: votacion.php');
                } else {//Si el login es erroneo salta el error de datos no validos
                    echo '<p>El nombre de usuario o la contraseña no son válidos</p>';
                }
            }
        }
    }
    ?>
</body>
</html>