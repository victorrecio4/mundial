<?php
    function authentication($conexion, $username, $password): bool
    {
        // Returns if the authentication was successful
        $sql = 'SELECT username, pass FROM autentificacion WHERE username = ? AND pass = ?';
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(1, $username);
        $consulta->bindParam(2, $password);
        $consulta->execute();
        $registrosEncontrados = $consulta->rowCount();
        if ($registrosEncontrados > 0) {
            // El usuario autentica, guardamos username en variable de sesión y redireccionamos
            session_start();
            $_SESSION['username'] = $_POST['usuario'];
            return true;
        }
        return false;
    }
    //Funcion para realizar el voto 
    function votar($conexion,$usuario,$seleccion): bool{
        //Comprabamos si el usuario ya ha realizado el voto
        if(comprobarVoto($conexion, $usuario)){
            //Si ha realizado el voto lo insertamos en la BD
            //Y tambien guardamos el numero de votos, le sumamos +1 y actualizamos la BD
            $sqlInsert="INSERT INTO `votacion`(`usuario`, `seleccion`) VALUES ('$usuario','$seleccion')";
            $consulta=$conexion->query($sqlInsert);
            $sqlVotos="SELECT votos FROM selecciones WHERE seleccion='$seleccion'";
            $numeroVotos=$conexion->query($sqlVotos);
            $num = $numeroVotos->fetch(PDO::FETCH_ASSOC);
            $numeroVotos=$num['votos'] + 1;
            $sqlUpdate="UPDATE `selecciones` SET `votos`='$numeroVotos' WHERE seleccion='$seleccion';";
            $resultado=$conexion->query($sqlUpdate);
            return true;
        }
        return false;
    }
    //Funcion para comprobar si el usuario a realizado ya un voto
    function comprobarVoto($conexion, $usuario): bool{
        $sql="SELECT * FROM votacion WHERE usuario = '$usuario'";
        $resultado=$conexion->query($sql);
        $filas= $resultado->rowCount();  
        if($filas==0){
            return  true;
        }   
        return false;
    }
    //Funcion para comprobar si el usuairo esta registrado en la BD
    function comprobarRegistro($conexion, $usuario): bool{
        $sql="SELECT * FROM autentificacion WHERE username = '$usuario'";
        $resultado=$conexion->query($sql);
        if($resultado==NULL){
            return false;
        }
        return true;
    }
    //Funcion para registrar un usuario en la BD
    function registrar($conexion, $usuario, $pass){
        $sql="INSERT INTO `autentificacion`(`username`, `pass`) VALUES ('$usuario','$pass')";
        $resultado=$conexion->query($sql);
    }
    //Funcion para recorrer los datos de una tabla
    function recorrerDatos($resultado) {
        while($filas = $resultado->fetch()){
            echo strtoupper('<div id="seleccion">'.$filas['seleccion']).'</div><div id="votos">'.$filas['votos'].'</div><br>';

        }
    }
?>