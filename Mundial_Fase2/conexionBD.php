<?php
	function conexionBD(): PDO {
		// Variables
		$host = 'localhost';
		$db = 'mundial';
		$user = 'root';
		$pass = '';
		$dsn = "mysql:host=$host;dbname=$db";
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH
		];
		try {
			$conexion = new PDO($dsn, $user, $pass, $options);
			return $conexion;
		} catch (PDOException $e) {
			echo "Excepción capturada: ", $e->getMessage(), (int)$e->getCode();
		}
	}
?>