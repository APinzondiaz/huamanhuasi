<?php
include_once('Database.php');
	
	$database_username = 'root';
	$database_password = '';
	$pdo_conn = new PDO( 'mysql:host=localhost;dbname=huamanhuasi', $database_username, $database_password );
	$conexion = new mysqli("localhost",$database_username,$database_password,"huamanhuasi");


define('SS_DB_NAME', 'huamanhuasi');
define('SS_DB_USER', 'root');
define('SS_DB_PASSWORD', '');
define('SS_DB_HOST', 'localhost');

$dsn	= 	"mysql:dbname=".SS_DB_NAME.";host=".SS_DB_HOST."";
$pdo	=	"";
try {
	$pdo = new PDO($dsn, SS_DB_USER, SS_DB_PASSWORD);
}catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
$db 	=	new Database($pdo);


?>