<?php
require_once('../include/usuario.php');
session_start();
if (!isset($_SESSION['usuario'])) {
	header('Location: ingreso_usuarios.php');
}
require_once("../include/db.php");



$sql = "SELECT * FROM fichero WHERE id_fichero=".$_REQUEST["id_fichero"];
echo "<br>".$sql;

$stmt = $pdo_conn->query($sql);
$nombre = $stmt->fetchColumn(4);

if ($nombre !== false) {
    
    $_ruta='C:\\xampp\\htdocs\\huamanhuasi\\admin\\ficheros\\'.$nombre;
    echo "<br>***".$_ruta;
    If (unlink($_ruta)) {
        $_ruta='ficheros/'.$nombre;
        unlink($_ruta);
        $sql = "DELETE FROM fichero WHERE fichero.id_fichero=".$_REQUEST["id_fichero"];
        echo "***********<br>".$sql."<br>**********";
        if ($pdo_conn->query($sql) == TRUE) {
            $flag	=	1;
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    } else {
        echo "Error no se ha podido borrar el fichero";
        ECHO "Nombre de fichero:".$nombre;
        return;
    }
}

if($flag	=	1){
	header('location:add_ficheros.php?msg=ras');
	exit;
}
?>