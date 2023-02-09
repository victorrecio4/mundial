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
        session_start();
        require 'funciones.php';
        require 'conexionBD.php';
        $conexion = conexionBD();
        //Creamos la consulta para poder sacar todos los datos de la tabla selecciones
        $sql = "SELECT * FROM `selecciones`";
        $resultado= $conexion->query($sql);  
        recorrerDatos($resultado);
        
    ?>

    <p><strong>Gracias por su votacion! </strong><a href="login.php"> Cerrar Sesion</a></p>
    <?php
        if(isset($_POST['cerrarSesion'])){
            session_destroy();
        }
    ?>
</body>
</html>