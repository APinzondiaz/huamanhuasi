<!doctype html>
<html lang="en">

<?php
require_once('cabecera.php');
?>

<body>
    <?php
    require_once('menu.php');

    if (isset($_REQUEST['accion']) and $_REQUEST['accion'] != "") {
        $accion = $_REQUEST["accion"];
    } else {
        $accion = "";
    }

    if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {
        //echo "Boton:".$_REQUEST['submit'];
        extract($_REQUEST);

        if ($accion == "NUEVO") {
            $data    =    array(
                'nombre_r' => $nombre,
            );

            $insert    =    $db->insert('ruta', $data);
            if ($insert) {
                $mesaje = "Registro almacenado correctamente";
                echo    '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i>' . $mesaje . '</div>';
                $accion = "";
            } else {
                $mesaje = "Error, el registro no se pudo almacenar";
            }
        }
        if ($accion == "EDITAR") {
            $data_SET    =    array(
                'nombre_R' => $nombre,
            );

            $data_WHERE    =    array(
                'id_ruta' => $id_ruta,
            );

            $actualizar = $db->update('ruta', $data_SET, $data_WHERE);
            if ($actualizar) {
                $mesaje = "Registro actualizado correctamente";
                echo    '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i>' . $mesaje . '</div>';
                $accion = "";
            } else {
                $mesaje = "Error, el registro no se pudo actualizar";
            }
        }
    }

    if ($accion == "EDITAR") {
        $id_ruta = $_REQUEST['id_ruta'];

        $condition    = " AND id_ruta=$id_ruta ";
        echo "<br>" . $condition . "<br>";
        $userData    =    $db->getAllRecords('ruta', '*', $condition, ' ORDER BY id_ruta ');
        foreach ($userData as $val) {
            $id_ruta = $val["id_ruta"];
            $nombre = $val["nombre_r"];
        }
    }

    if ($accion == "ELIMINAR") {
        $id_ruta = $_REQUEST['id_ruta'];

        $data    =    array(
            'id_ruta' => $id_ruta,
        );

        $borrar = $db->delete('ruta', $data);

        if ($borrar) {
            $mesaje = "Registro eliminado correctamente";
            echo    '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>' . $mesaje . '</div>';
            $accion = "";
        } else {
            $mesaje = "Registro no se pudo eliminar";
        }
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-head">
                        <h5 class="card-title form-control">Administración de rutas</h5>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nombre ruta</label>
                                <input required type="hidden" class="form-control" name="accion" id="accion" <?php if ($accion == "EDITAR") {
                                                                                                                    echo " value=EDITAR";
                                                                                                                } else {
                                                                                                                    echo "value=NUEVO";
                                                                                                                } ?>>
                                <input required type="hidden" class="form-control" name="id_ruta" id="id_ruta" <?php if ($accion == "EDITAR") {
                                                                                                                    echo " value=" . $id_ruta;
                                                                                                                } ?>>
                                <input required type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre de la ruta" <?php if ($accion == "EDITAR") {
                                                                                                                                                            echo " value='" . $nombre . "'";
                                                                                                                                                        } ?>>
                            </div>
                            <div class="mb-3">
                                <button name="submit" value="submit" id="submit" type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-head">
                    <div class="card">
                        <div class="card-head">
                            <h5 class="card-title form-control titulo">Lista de rutas disponibles</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="table-active">Id</th>
                                        <th class="table-active">Nombre</th>
                                        <th class="table-active">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $condition	="  ";
                                        $userData	=	$db->getAllRecords('ruta','*',$condition,' ORDER BY id_ruta ',' LIMIT 50');
                                        if(count($userData)>0){
                                            $s	=	'';
                                            foreach($userData as $val){
                                                $s++;
                                                echo "<tr>";
                                                    echo "<td >".$val['id_ruta']."</td>";
                                                    echo "<td >".$val['nombre_r']."</td>";
                                                    echo "<td >";
                                                    echo "<a href='ruta.php?accion=EDITAR&id_ruta=".$val['id_ruta']."'>Editar</a>"; 
                                                    echo " <a href='ruta.php?accion=ELIMINAR&id_ruta=".$val['id_ruta']."'>Borrar</a>";
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                        }
?>
                                </tbody>
                            </table>
                    </div>
                </div>

                        </div>
                    </div>
</body>

</html>