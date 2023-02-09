<?php
     class Usuario{
        //Variables
        public $username;
        public $pass;
        //Constructor
        public function __construct($username, $pass){
            $this->username = $username;
            $this->pass = $pass;
        }
        //Get
        public function getNombre(){
            return $this->username;
        }
        //Metodos 

        /**
         * Metodo para Registar un usuario a la BD
         * @param $conexion para poder realizar la conexion con la BD
         * @param $username Nombre del usuario
         * @param $pass Contraseña del usuario
         */
        public function registrarUsuario($conexion,$username, $pass){
                $sql="INSERT INTO `autentificacion`(`username`, `pass`) VALUES ('$username','$pass')";
                $resultado=$conexion->query($sql);
           
        }
        /**
         * Metodo para comprobar si usuario esta registrado ya en la BD
         * @param $conexion para poder realizar la conexion con la BD
         * @param $usuario Nombre del usuario
         * @return true si el usuario esta registrado en el sistema
         * @return false si el usuario no esta registrado en el sistema
         */
        public function comprobarUsuario($conexion, $usuario){
            $sql="SELECT * FROM autentificacion WHERE username = '$usuario'";
            $resultado=$conexion->query($sql);
            if($resultado==NULL){
                return false;
            }
            return true;
        }
        /**
         * Metodo para comprobar si usuario esta registrado ya en la BD
         * @param $conexion para poder realizar la conexion con la BD
         * @param $usuario Nombre del usuario
         * @return true si el usuario esta registrado en el sistema
         * @return false si el usuario no esta registrado en el sistema
         */
        public function login($conexion, $username, $pass){
            // Returns if the authentication was successful
        $sql = 'SELECT username, pass FROM autentificacion WHERE username = ? AND pass = ?';
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(1, $username);
        $consulta->bindParam(2, $pass);
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
        
     }
?>