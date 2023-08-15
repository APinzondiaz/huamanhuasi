<!doctype html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/mostrar_vista_previa.js"></script>
<?php
require_once('cabecera.php');
//*Códgio insertar, editar,borrar

if (isset($_REQUEST['accion']) and $_REQUEST['accion'] != "") {
  $accion = $_REQUEST["accion"];
} else {
  $accion = "";
}

if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {
  extract($_REQUEST);
  // Verificar si el formulario ha sido enviado por metodo POST
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Definir la variable $fecha
    if (isset($_POST['fecha'])) {
      $fecha = $_POST['fecha'];
    }

    // Definir la variable $nombre_archivo (del archivo cargado)
    if (isset($_FILES["imagen"]["name"])) {
      $nombre_archivo = $_FILES["imagen"]["name"];
    } elseif ($accion == "EDITAR") {
      // Obtener el ID de la ruta intervenida de la solicitud
      if (isset($_REQUEST['id_rutaintervenida'])) {
        $id_rutaintervenida = $_REQUEST['id_rutaintervenida'];
      }

      // Verificar si el formulario ha sido enviado
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Resto del código para la acción EDITAR


        // Obtener los datos actualizados del formulario
        $id_rutaintervenida = $_POST['id_rutaintervenida'];
        $descripcion_actualizada = $_POST['descripcion'];
        $fecha_actualizado = $_POST['fecha'];
        $estado_actualizado = $_POST['estado'];
        $imagen_actualizado = $_POST['imagen'];

        // Preparar el arreglo con los datos actualizados
        $data_actualizada = array(
          'descripcion' => $descripcion_actualizada,
          'fecha' => $fecha_actualizado,
          'estado' => $estado_actualizado,
          'imagen' => $imagen_actualizado,
        );

        // Realizar la actualización en la base de datos
        $actualizacion = $db->update('rutasintervenidas', $data_actualizada, "id_rutaintervenida=$id_rutaintervenida");

        // Verificar si la actualización fue exitosa
        if ($actualizacion) {
          $mensaje = "Registro actualizado correctamente";
          echo '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i>' . $mensaje . '</div>';
          // Puedes redirigir a otra página después de la actualización si lo deseas
          // header("Location: otra_pagina.php");
        } else {
          $mensaje = "Error, el registro no se pudo actualizar";
        }
      } else {
        // Obtener los datos de la ruta intervenida para mostrar en el formulario de edición
        $condition = " AND id_rutaintervenida = $id_rutaintervenida ";
        $userData = $db->getAllRecords('rutasintervenida', '*', $condition, ' ORDER BY id_rutaintervenida ');

        // Verificar si se encontraron datos para la ruta intervenida
        if ($userData) {
          // Asignar los valores correspondientes a las variables para mostrar en el formulario
          foreach ($userData as $val) {
            $id_arbol = $val["id_arbol"];
            $id_ruta = $val["id_ruta"];
            $descripcion = $val["descripcion"];
            $fecha = $val["fecha"];
            $estado = $val["estado"];
            $nombre_archivo = $val["imagen"];
          }
        } else {
          // No se encontraron datos para la ruta intervenida, mostrar mensaje de error o redirigir a otra página
          echo "Error: No se encontraron datos para la ruta intervenida.";
          exit; // O redirigir a otra página con header("Location: otra_pagina.php");
        }
      }
    }
  }

  if ($accion == "EDITAR") {
    $id_rutaintervenida = $_REQUEST['id_rutaintervenida'];

    $condition = " AND id_rutaintervenida=$id_rutaintervenida ";
    echo "<br>" . $condition . "<br>";
    $userData = $db->getAllRecords('rutasintervenida', '*', $condition, ' ORDER BY id_rutaintervenida ');
    foreach ($userData as $val) {
      $id_rutaintervenida = $val["id_rutaintervenida"];
      $id_arbol = $val["id_arbol"];
      $id_ruta = $val["id_ruta"];
      $descripcion = $val["descripcion"];
      $fecha = $val["fecha"];
      $estado = $val["estado"];
      $nombre_archivo = $val["imagen"];
    }
  }

  if ($accion == "ELIMINAR") {
    $id_rutaintervenida = $_REQUEST['id_rutaintervenida'];

    $data = array(
      'id_rutaintervenida' => $id_rutaintervenida,
    );

    $borrar = $db->delete('rutaintervenida', $data);

    if ($borrar) {
      $mesaje = "Registro eliminado correctamente";
      echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>' . $mesaje . '</div>';
      $accion = "";
    } else {
      $mesaje = "Registro no se pudo eliminar";
    }
  }
}
?>

<title>RUTAS INTERVENIDAS</title>
<style type="text/css">
  .titulo {
    color: #000000;
    background-color: #CCCCCC;
  }
</style>

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
            <form method="POST" enctype="multipart/form-data" id="formularioRutas">
              <!-- Resto del formulario existente -->
              
             
              <div class="form-group">
                <label for="exampleFormControlSelect1">Elija la ruta</label>
                <select class="form-control" id="id_ruta" name="id_rutaintervenida">
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
              </div>


              <div class="form-group">
                <label for="exampleFormControlTextarea1">Descripción del arbol</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">
                <?php if ($accion == "EDITAR") {
                  echo $descripcion;
                } ?>
                </textarea>
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
                  $directorio_subida = "images/";

                  // Depurar la variable $error_archivo
                  var_dump($error_archivo);

                  // Asegurarse de que el archivo se haya cargado correctamente
                  if ($error_archivo === UPLOAD_ERR_OK) {
                    // Comprobar el tipo de archivo (opcional)
                    $permitidos = array("image/jpeg", "image/png", "image/gif");
                    if (in_array($tipo_archivo, $permitidos)) {
                      // Mover el archivo temporal al directorio de destino
                      if (move_uploaded_file($temp_archivo, $directorio_subida . $nombre_archivo)) {
                        // Datos para insertar en la base de datos
                        $data = array(
                          'id_rutaintervenida' => $id_rutaintervenida,
                          'descripcion' => $descripcion,
                          'fecha' => $fecha,
                          'estado' => $estado,
                          'imagen' => $nombre_archivo, // Guardamos el nombre de la imagen en la base de datos
                        );

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
              <!-- Botón de guardar -->
              <button name="submit" id="submit" value="submit" type="submit" class="btn btn-primary">Guardar</button>
            </form>
            <!-- Código JavaScript para limpiar el formulario después de enviar los datos -->
            <script>
              $(document).ready(function() {
                // Limpiar el formulario después de enviar los datos
                $("#formularioRutas").submit(function() {
                  $(this).get(0).reset();
                  $("#vistaPrevia").attr("src", "#").hide();
                  $("#id_ruta").val("0"); // Restablecer opción "Seleccione la ruta"
                });
              });
            </script>
            <?php
            if ($accion == "EDITAR") {
              echo "<input type='hidden' name='id_rutaintervenida' value='" . $id_rutaintervenida . "'>"; // Agregar este campo oculto para enviar el ID
            }
            ?>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-sm">

        <div class="card">
          <div class="card-head ">
            <h5 class="card-title form-control titulo">Lista de árboles</h5>
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
                  <th scope="col">id_arbol</th>
                  <th scope="col">id_ruta</th>
                  <th scope="col">Descripción</th>
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

                $userData = $db->getAllRecords('rutasintervenidas', '*', $condicion, 'ORDER BY id_rutaintervenida', ' LIMIT 50');
                if (!empty($userData)) {
                  $s  =  '';
                  foreach ($userData as $val) {
                    $s++;
                    echo "<tr>";
                    echo "<th scope='row'>" . $val['id_rutaintervenida'] . "</th>";
                    echo "<th scope='row'>" . $val['id_arbol'] . "</th>";
                    echo "<td scope='row'>>" . $val['id_ruta'] . "</td>";
                    echo "<td >" . $val['descripcion'] . "</td>";
                    echo "<td >" . $val['Fecha'] . "</td>";
                    echo "<td >" . $val['estado'] . "</td>";
                    echo "<td><img src='images/" . $val['imagen'] . "' width='100' height='100'></td>";
                    echo "<td >" . $val['Acciones'] . "</td>";
                    echo "<td >";
                    echo "<a href='rutasintervenidas.php?accion=EDITAR&id_rutaintervenida=" . $val['id_rutaintervenida'] . "'>Editar</a>";
                    echo " <a href='rutasintervenidas.php?accion=ELIMINAR&id_rutaintervenida=" . $val['id_rutaintervenida'] . "'>Borrar</a>";
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