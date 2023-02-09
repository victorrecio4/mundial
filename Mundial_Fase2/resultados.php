<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #votos{
            display: inline-block;
            padding: 0;
            border: 0;
        }
    </style>
</head>
<body>
    
    <h1>RESULTADO DE LAS PREDICIONES</h1>
    <?php
        //Inicamos la sesion
        session_start();
        require 'conexionBD.php';
        $conexion = conexionBD();
        //Creamos la consulta para recorrer los datos de la tabla seleccion
        $sql = "SELECT * FROM `selecciones`";
         
        recorrerDatos($conexion,$sql);

        /**
         * Funcion para recorrer los datos de una consulta
         * @param $conexion para la conexion a la BD
         * @param $sql consulta SQL
         * Y muestra por pantalla las filas las cuales mostraran las selecciones con sus respectivos votos
         */
        function recorrerDatos($conexion, $sql) {
            $resultado= $conexion->query($sql); 
            while($filas = $resultado->fetch()){
                echo strtoupper('<div id="seleccion">'.$filas['seleccion']).'</div><div id="votos">'.$filas['votos'].'</div><br>';
    
            }
        }
    ?>

    <p><strong>Gracias por su votacion! </strong><a href="login.php"> Cerrar Sesion</a></p>
    <?php
    //Cerramos la sesion
        if(isset($_POST['cerrarSesion'])){
            session_destroy();
        }
    ?>
</body>
</html>