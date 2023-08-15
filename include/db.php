<?php
	$database_username = 'root';
	$database_password = '';
	$pdo_conn = new PDO( 'mysql:host=localhost;dbname=huamanhuasi', $database_username, $database_password );
	$conexion = new mysqli("localhost",$database_username,$database_password,"huamanhuasi");
	

?>