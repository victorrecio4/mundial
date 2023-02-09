<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{
            text-align: center;
        }
        form{
            display: grid;
            
        }
        label,input[type="submit"]{
            border: 1px solid black;
            margin-left: 20%;
            margin-right: 20%;
            margin-top:10px;
          
        }
        img{
            width:40px;
            margin-top:5px;   
        }

    </style>
</head>
<body>
    <h1>¿Qué equipo saldra campeon mundial de Qatar?</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label><input type="radio" id="argentina" name="mundial" value="argentina">Argentina <img src="./fotos/argentina.png" alt="ARG"></label>
        <label><input type="radio" id="australia" name="mundial" value="australia">Australia <img src="./fotos/australia1.png" alt="AUS"></label>
        <label><input type="radio" id="paisesBajos" name="mundial" value="paisesBajos">Paises Bajos <img src="./fotos/holanda.png" alt="HOL"></label>
        <label><input type="radio" id="EEUU" name="mundial" value="EEUU">Estados Unidos <img src="./fotos/eeuu.png" alt="USA"></label>
        <label><input type="radio" id="japon" name="mundial" value="japon">Japon <img src="./fotos/japon1.png" alt="JAP"></label>
        <label><input type="radio" id="croacia" name="mundial" value="croacia">Croacia <img src="./fotos/croacia.jfif" alt="CRO"></label>
        <label><input type="radio" id="brasil" name="mundial" value="brasil">Brasil <img src="./fotos/brasil.png" alt="BRA"></label>
        <label><input type="radio" id="Corea del Sur" name="mundial" value="Corea del Sur">Corea del Sur <img src="./fotos/corea.png" alt="CDS"></label>
        <label><input type="radio" id="inglaterra" name="mundial" value="inglaterra">Inglaterra <img src="./fotos/inglaterra.png" alt="ING"></label>
        <label><input type="radio" id="senegal" name="mundial" value="senegal">Senegal <img src="./fotos/senegal.png" alt="SEN"></label>
        <label><input type="radio" id="francia" name="mundial" value="francia">Francia <img src="./fotos/francia.png" alt="FRA"></label>
        <label><input type="radio" id="polonia" name="mundial" value="polonia">Polonia <img src="./fotos/polonia.jfif" alt="POL"></label>
        <label><input type="radio" id="marruecos" name="mundial" value="marruecos">Marruecos <img src="./fotos/marruecos.png" alt="MAR"></label>
        <label><input type="radio" id="españa" name="mundial" value="españa">España <img src="./fotos/espana.png" alt="ESP"></label>
        <label><input type="radio" id="portugal" name="mundial" value="portugal">Portugal <img src="./fotos/portugal.png" alt="POR"></label>
        <label><input type="radio" id="suiza" name="mundial" value="suiza">Suiza <img src="./fotos/suiza.png" alt="SUI"></label>
        <input type="submit" id="boton" name="boton" value="Enviar Voto">
    </form>
    <a href="login.php">Cerrar Sesion</a>
    
  <?php
    require 'funciones.php';
    require 'conexionBD.php';
    session_start();
    //Variables
    $conexion=conexionBD();
    $usuario;
    $seleccionVotada;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //Si el usuario y la seleccion no estan vacias
        if(isset($_SESSION['username']) &&  isset($_POST['mundial'])){
            //Guardamos el usuario y la seleccion votada en sus respectivas variables
            $usuario=$_SESSION['username'];
            $seleccionVotada=$_POST['mundial'];
            //Si votar el true abrimos la pagina resultados
            if(votar($conexion, $usuario, $seleccionVotada)){
                header('Location: resultados.php');
            }else{ //Si es false salta el ERROR
                echo '<p>ERROR. Ya has realizado el voto con esta cuenta </p>';
            }
        }
    }
  ?>
</body>
</html>