<?php
    class Voto{
        //Variables
        public $nombreUsuario;
        public $seleccion;
        //Contructor
        public function __construct($nombreUsuario, $seleccion){
            $this->nombreUsuario = $nombreUsuario;
            $this->seleccion = $seleccion;
        }
        //Metodos 
        /**
         * Metodo para añadir voto a la BD
         * Comprobamos si el usuario ya ha realizado un voto
         * Si no ha realizado ningun voto prodecemos ha ejecutar un INSERT en a la base de datos
         * Y sumas +1 voto en su seleccion respectiva
         * @param $conexion para poder realizar la conexion con la BD
         * @param $nombreUsuario Nombre del usuario
         * @param $seleccion Nombre de la seleccion 
         * @return true si se realiza correctamente el voto
         * @return false si no se realiza el voto
         */
        public function votar($conexion, $nombreUsuario, $seleccion){
                $sqlInsert="INSERT INTO `votacion`(`usuario`, `seleccion`) VALUES ('$nombreUsuario','$seleccion')";
                $consulta=$conexion->query($sqlInsert);
                $sqlVotos="SELECT votos FROM selecciones WHERE seleccion='$seleccion'";
                $numeroVotos=$conexion->query($sqlVotos);
                $num = $numeroVotos->fetch(PDO::FETCH_ASSOC);
                $numeroVotos=$num['votos'] + 1;
                $sqlUpdate="UPDATE `selecciones` SET `votos`='$numeroVotos' WHERE seleccion='$seleccion';";
                $resultado=$conexion->query($sqlUpdate);
        }
         /**
         * Metodo para comprobar si el usuario a votado
         * Buscamos en la base de datos si el usuario a realizado algun voto
         * Contamos las filas de la consulta
         * @param $conexion para poder realizar la conexion con la BD
         * @param $nombreUsuario Nombre del usuario
         * @return true si no se a realizado ningun voto
         * @return false si se ha realizado algun voto
         */
        public function comprobarVoto($conexion, $nombreUsuario){
            $sql="SELECT * FROM votacion WHERE usuario = '$nombreUsuario'";
            $resultado=$conexion->query($sql);
            $filas= $resultado->rowCount();  
            if($filas==0){
                return  true;
            }   
            return false;
        }
    }
?>