<!doctype html>
<html lang="en">

<?php
require_once('cabecera.php');
//*Códgio insertar, editar,borrar
var_dump($_REQUEST);
if (isset($_REQUEST['accion']) and $_REQUEST['accion'] != "") {
  $accion = $_REQUEST["accion"];
} else {
  $accion = "";
}

if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {
  //echo "Boton:".$_REQUEST['submit'];
  extract($_REQUEST);

  if ($accion == "NUEVO") {
    $data = array(
      'descripcion' => $descripcion,
      'estado' => $estado,
      'id_ruta' => $id_ruta,
    );

    $insert = $db->insert('arbol', $data);
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
      'id_arbol' => $id_arbol,
      'descripcion' => $descripcion,
      'estado' => $estado,
    );

    $data_WHERE = array(
      'id_arbol' => $id_arbol,
    );

    $actualizar = $db->update('arbol', $data_SET, $data_WHERE);
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
  $id_arbol = $_REQUEST['id_arbol'];

  $condition = " AND id_arbol=$id_arbol ";
  echo "<br>" . $condition . "<br>";
  $userData = $db->getAllRecords('arbol', '*', $condition, ' ORDER BY id_arbol ');
  foreach ($userData as $val) {

    $id_arbol = $val["id_arbol"];
    $id_ruta = $val["id_ruta"];
    $descripcion = $val["descripcion"];
    $estado = $val["estado"];
  }
}

if ($accion == "ELIMINAR") {
  $id_arbol = $_REQUEST['id_arbol'];

  $data = array(
    'id_arbol' => $id_arbol,
  );

  $borrar = $db->delete('arbol', $data);

  if ($borrar) {
    $mesaje = "Registro eliminado correctamente";
    echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>' . $mesaje . '</div>';
    $accion = "";
  } else {
    $mesaje = "Registro no se pudo eliminar";
  }
}
?>
<title>Administracion de arbol</title>
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
            <h5 class="card-title form-control titulo">Administración de árboles</h5>
          </div>
          <div class="card-body">
            <form>
              
              <input required type="hidden" class="form-control" name="accion" id="accion" <?php if ($accion == "EDITAR") {
                                                                                              echo " value=EDITAR";
                                                                                            } else {
                                                                                              echo "value=NUEVO";
                                                                                            } ?>>
              <input required type="hidden" class="form-control" name="id_arbol" id="id_arbol" <?php if ($accion == "EDITAR") {
                                                                                                  echo " value='" . $id_arbol . "'";
                                                                                                } ?>>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Elija la ruta</label>
                <select class="form-control" id="id_ruta" name="id_ruta">
                  <option value='0'>Seleccione la ruta</option>
                  <?php
                  $condition  = "  ";
                  $userData  =  $db->getAllRecords('ruta', '*', $condition, ' ORDER BY id_ruta ', ' LIMIT 50');
                  if (count($userData) > 0) {
                    $s  =  '';
                    foreach ($userData as $val) {
                      if ($val['id_ruta'] == $id_ruta) {
                        echo "<option selected value='" . $val['id_ruta'] . "'>" . $val['nombre_r'] . "</option>";
                      } else {
                        echo "<option  value='" . $val['id_ruta'] . "'>" . $val['nombre_r'] . "</option>";
                      }
                    }
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
              <button name="submit" id="submit" value="submit" type="submit" class="btn btn-primary">Guardar</button>
            </form>

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
                  <th scope="col">id_arbol</th>
                  <th scope="col">id_ruta</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $condicion = "";
                if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {
                  extract($_REQUEST);
                  if ($accion == "Buscar") {
                    echo "Esta buscando<br>";
                    $condicion = " and descripcion like '%" . $txtBuscar . "%' ";
                  } else {
                    $condicion = "";
                  }
                }

                $userData  =  $db->getAllRecords('arbol', '*', $condicion, 'ORDER BY id_arbol', ' LIMIT 50');

                if (!empty($userData)) {
                  $s  =  '';
                  foreach ($userData as $val) {
                    $s++;
                    echo "<tr>";
                    echo "<th scope='row'>" . $val['id_arbol'] . "</th>";
                    echo "<td >" . $val['id_ruta'] . "</td>";
                    echo "<td >" . $val['descripcion'] . "</td>";
                    echo "<td >" . $val['estado'] . "</td>";
                    echo "<td >";
                    echo "<a href='arbol.php?accion=EDITAR&id_arbol=" . $val['id_arbol'] . "'>Editar</a>";
                    echo " <a href='arbol.php?accion=ELIMINAR&id_arbol=" . $val['id_arbol'] . "'>Borrar</a>";
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