<?php
require_once('../include/usuario.php');
session_start();
if (!isset($_SESSION['usuario'])) {
	header('Location: ingreso_usuarios.php');
}

require_once("../include/db.php");
include_once('../include/config.php');
include_once('az.multi.upload.class.php');

$rename	=	rand(1000,5000).time();
$upload	=	new ImageUploadAndResize();
$upload->uploadMultiFiles('files', 'ficheros', $rename, 0755);

foreach($upload->prepareNames as $name){
    $sql = "INSERT INTO fichero (id_administrador,nombre,descripcion) VALUES (".$_SESSION['usuario']->getId().",'".$name."','".$_REQUEST["descripcion"]."')";
 	$flag	=	0;
    if ($conexion->query($sql) === TRUE) {
        $flag	=	1;
        $info = new SplFileInfo($name);
        //move_uploaded_file("/var/www/html/smistms/fciheros/".$name,"/var/www/fciheros/".$name);
        //copy("/var/www/html/smistms/ficheros/".$name,"/var/www/ficheros/".$name
        //copy("/var/www/html/smistms/ficheros/".$name,"/var/www/ficheros/".$name)
        if( (strtolower($info->getExtension())=="pdf") or (strtolower($info->getExtension())=="doc" or strtolower($info->getExtension())=="docx" or strtolower($info->getExtension())=="jpg" or strtolower($info->getExtension())=="jpeg")  ){
            if (copy("C:\\xampp\\htdocs\\huamanhuasi\\admin\\ficheros\\".$name,"C:\\ficheros\\".$name))
            {
                //unlink("C:\\xampp\\htdocs\\SMistms\\ficheros\\".$name);
                //unlink("/var/www/html/smistms/ficheros/".$name);
                echo "Se ha movido el fichero correctamente"; 
            }
            else
            {echo "Error, no se ha podido copiar el fichero";return;}
        }
        else
        {echo "<br>ERROR, La extensión no es adecuada";}
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

if($flag	=	1){
	header('location:add_ficheros.php?msg=ras');
	exit;
}
?>