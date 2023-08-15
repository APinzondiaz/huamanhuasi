<!DOCTYPE html>
<html lang="en">
<script src="js/mostrar_vista_previa.js"></script>
<?php
require_once('cabecera.php');
//*Códgio insertar, editar,borrar
var_dump($_REQUEST);
if (isset($_REQUEST['accion']) and $_REQUEST['accion'] != "") {
    $accion = $_REQUEST["accion"];
} else {
    $accion = "";
}
//*Códgio insertar, editar,borrar

if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {
    //echo "Boton:".$_REQUEST['submit'];
    extract($_REQUEST);

    if ($accion == "NUEVO") {
        $data = array(
            'estado' => $estado,
            'fecha' => $fecha,
            'imagen' => $imagen,
            'id_rutasintervenidas' => $id_rutasintervenidas,
        );

        $insert = $db->insert('rutasintervenidas', $data);
        if ($insert) {
            $mesaje = "Registro almacenado correctamente";
            echo '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i>' . $mesaje . '</div>';
            $accion = "";
        } else {
            $mesaje = "Error, el registro no se pudo almacenar";
        }
    }
    if ($accion == "EDITAR") {
        $data_SET = array(
            'id_rutasintervenidas' => $id_rutasintervenidas,
            'estado' => $estado,
            'fecha' => $fecha,
            'imagen' => $imagen,
        );

        $data_WHERE = array(
            'id_rutasintervenidas' => $id_rutasintervenidas,
        );

        $actualizar = $db->update('rutasintervenidas', $data_SET, $data_WHERE);
        if ($actualizar) {
            $mesaje = "Registro actualizado correctamente";
            echo '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i>' . $mesaje . '</div>';
            $accion = "";
        } else {
            $mesaje = "Error, el registro no se pudo actualizar";
        }
    }
}

if ($accion == "EDITAR") {
    $id_rutasintervenidas = $_REQUEST['id_rutasintervenidas'];

    $condition = " AND id_rutasintervenidas=$id_rutasintervenidas ";
    echo "<br>" . $condition . "<br>";
    $userData = $db->getAllRecords('rutasintervenidas', '*', $condition, ' ORDER BY id_rutasintervenidas ');
    foreach ($userData as $val) {

        $id_rutasintervenidas = $val["id_rutasintervenidas"];
        $estado = $val["estado"];
        $fecha = $val["fecha"];
        $imagen = $val["imagen"];
    }
}

if ($accion == "ELIMINAR") {
    $id_rutasintervenidas = $_REQUEST['id_rutasintervenidas'];

    $data = array(
        'id_rutasintervenidas' => $id_rutasintervenidas,
    );

    $borrar = $db->delete('rutasintervenidas', $data);

    if ($borrar) {
        $mesaje = "Registro eliminado correctamente";
        echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>' . $mesaje . '</div>';
        $accion = "";
    } else {
        $mesaje = "Registro no se pudo eliminar";
    }
}
?>

<body>
    <?php
    require_once('menu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm">

                <div class="card">
                    <div class="card-head ">
                        <h5 class="card-title form-control titulo">RUTAS INTERVENIDAS</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <input required type="hidden" class="form-control" name="accion" id="accion" <?php if ($accion == "EDITAR") {
                                                                                                                echo " value=EDITAR";
                                                                                                            } else {
                                                                                                                echo "value=NUEVO";
                                                                                                            } ?>>
                            <input required type="hidden" class="form-control" name="id_rutasintervenidas" id="id_rutasintervenidas" <?php if ($accion == "EDITAR") {
                                                                                                                                            echo " value='" . $id_rutasintervenidas . "'";
                                                                                                                                        } ?>>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Elija la ruta</label>
                                <select class="form-control" id="id_ruta" name="id_ruta">
                                    <?php
                                    $condition  = "  ";
                                    $userData  =  $db->getAllRecords('ruta', '*', $condition, ' ORDER BY id_ruta ', ' LIMIT 50');
                                    if (count($userData) > 0) {
                                        $hasSelected = false;
                                        foreach ($userData as $val) {
                                            if ($val['id_ruta'] == $id_ruta) {
                                                echo "<option selected value='" . $val['id_ruta'] . "'>" . $val['nombre_r'] . "</option>";
                                                $hasSelected = true;
                                            } else {
                                                echo "<option value='" . $val['id_ruta'] . "'>" . $val['nombre_r'] . "</option>";
                                            }
                                        }
                                        // Si no hay ruta seleccionada, mostrar mensaje predeterminado
                                        if (!$hasSelected) {
                                            echo "<option disabled selected>Seleccione la ruta</option>";
                                        }
                                    } else {
                                        // Si no hay rutas en la base de datos, mostrar mensaje predeterminado
                                        echo "<option disabled selected>Seleccione la ruta</option>";
                                    }
                                    ?>
                                </select>
                                <div class="form-group">
                                    <label for="id_arbol">Elija el árbol:</label>
                                    <select class="form-control" id="id_arbol" name="id_arbol">
                                        <?php
                                        if (isset($_REQUEST['id_ruta'])) {
                                            $id_ruta = $_REQUEST['id_ruta'];
                                            var_dump($_REQUEST['id_ruta']);
                                            $condition = " AND id_ruta = $id_ruta ";
                                            $arbolData = $db->getAllRecords('arbol', '*', $condition, ' ORDER BY id_arbol ', ' LIMIT 50');
                                            if (count($arbolData) > 0) {
                                                foreach ($arbolData as $arbol) {
                                                    echo "<option value='" . $arbol['id_arbol'] . "'>" . $arbol['descripcion'] . "</option>";
                                                }
                                            } else {
                                                echo "<option disabled>No hay árboles disponibles en esta ruta</option>";
                                            }
                                        } else {
                                            echo "<option disabled>Primero seleccione una ruta</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Estado del árbol</label>

                                <select class="form-control" id="estado" name="estado">
                                    <option value='No definido'>Elija un estado</option>
                                    <option value="Saludable" <?php
                                                                if ($accion == "EDITAR") {
                                                                    if ($estado == "Saludable") {
                                                                        echo " selected ";
                                                                    }
                                                                }
                                                                ?>>Saludable</option>
                                    <option value="Extinto" <?php
                                                            if ($accion == "EDITAR") {
                                                                if ($estado == "Extinto") {
                                                                    echo " selected ";
                                                                }
                                                            }
                                                            ?>>Extinto</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha de intervención:</label>
                                <input required type="date" class="form-control" name="fecha" id="fecha" value="<?php echo isset($fecha) ? $fecha : ''; ?>">
                            </div>
                            <script>
                                // Función para limpiar el campo de fecha después de enviar el formulario
                                function limpiarFecha() {
                                    document.getElementById('fecha').value = '';
                                }
                            </script>
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                // Verificar si se seleccionó una imagen
                                if ($_FILES["imagen"]["error"] === 4) {
                                    echo "Por favor, seleccione una imagen.";
                                } else {
                                    $nombre_archivo = $_FILES["imagen"]["name"];
                                    $tipo_archivo = $_FILES["imagen"]["type"];
                                    $tamano_archivo = $_FILES["imagen"]["size"];
                                    $temp_archivo = $_FILES["imagen"]["tmp_name"];
                                    $error_archivo = $_FILES["imagen"]["error"];

                                    // Directorio donde se almacenarán las imágenes (debe tener permisos de escritura)
                                    $directorio_subida = "imagenes/";

                                    // Depurar la variable $error_archivo
                                    var_dump($error_archivo);

                                    // Asegurarse de que el archivo se haya cargado correctamente
                                    if ($error_archivo === UPLOAD_ERR_OK) {
                                        // Comprobar el tipo de archivo (opcional)
                                        $permitidos = array("image/jpeg", "image/png", "image/gif");
                                        if (in_array($tipo_archivo, $permitidos)) {
                                            // Mover el archivo temporal al directorio de destino
                                            if (move_uploaded_file($temp_archivo, $directorio_subida . '\\' . $nombre_archivo)) {
                                                // Insertar datos en la base de datos
                                                $insert = $db->insert('imagen', $data);
                                                if ($insert) {
                                                    $mesaje = "Registro almacenado correctamente";
                                                    echo '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i>' . $mesaje . '</div>';
                                                    $accion = "";
                                                } else {
                                                    $mesaje = "Error, el registro no se pudo almacenar";
                                                }
                                            } else {
                                                echo "Error al subir la imagen.";
                                            }
                                        } else {
                                            echo "Tipo de archivo no válido. Se permiten solo imágenes JPEG, PNG o GIF.";
                                        }
                                    } else {
                                        echo "Error al cargar el archivo: " . $error_archivo;
                                    }
                                }
                            }
                            ?>
                            <input type="file" name="imagen" id="imagen" style="display: none;">
                            <label for="imagen" class="btn btn-primary">Seleccionar imagen</label>
                            <br>
                            <!-- Vista previa de la imagen -->
                            <img id="vistaPrevia" src="#" alt="Vista previa de la imagen" style="max-width: 200px; max-height: 200px; display: none;">
                            <br>
                            <button name="submit" id="submit" value="submit" type="submit" class="btn btn-primary">enviar</button>
                        </form>
                        </th>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div class="container">
        <div class="row">
            <div class="col-sm">

                <div class="card">
                    <div class="card-head ">
                        <h5 class="card-title form-control titulo">Lista de Intervenciones</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <form>
                                    <tr>
                                        <th scope="col">Buscar:</th>
                                        <th scope="col">
                                            <input required type="hidden" class="form-control" name="accion" id="accion" value="Buscar">
                                            <input type="text" class="form-control" name="txtBuscar" id="txtBuscar" value="" placeholder="Ingrese el texto a buscar">
                                        </th>
                                        <th scope="col">
                                            <button name="submit" id="submit" value="submit" type="submit" class="btn btn-primary">Buscar</button>
                                        </th>
                                        <th scope="col"> </th>
                                    </tr>
                                </form>
                                <tr>
                                    <th scope="col">id_rutaIntervenida</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $condicion = "";
                                if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {
                                    extract($_REQUEST);
                                    if ($accion == "Buscar") {
                                        $condicion = " and descripcion like '%" . $txtBuscar . "%' "; // Utilizamos la variable $txtBuscar para filtrar por descripción
                                    } else {
                                        $condicion = "";
                                    }
                                }

                                $userData = $db->getAllRecords('rutasintervenidas', '*', $condicion, 'ORDER BY id_rutasintervenidas', ' LIMIT 50');
                                if (!empty($userData)) {
                                    $s  =  '';
                                    foreach ($userData as $val) {
                                        $s++;
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $val['id_rutasintervenidas'] . "</th>";
                                        echo "<td >" . $val['fecha'] . "</td>";
                                        echo "<td >" . $val['estado'] . "</td>";
                                        echo "<td><img src='/huamanhuasi/imagenes/" . $val['imagen'] . "' width='100' height='100'></td>";

                                        echo "<td >";
                                        echo "<a href='intervenido.php?accion=EDITAR&id_rutasintervenidas=" . $val['id_rutasintervenidas'] . "'>Editar</a>";
                                        echo "<a href='intervenido.php?accion=ELIMINAR&id_rutasintervenidas=" . $val['id_rutasintervenidas'] . "'>Borrar</a>";
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
    </div>
</body>

</html>