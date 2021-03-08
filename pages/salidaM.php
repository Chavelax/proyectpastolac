<script LANGUAGE="JavaScript">
  function confirmDel(url) {
    //var agree = confirm("¿Realmente desea eliminarlo?");
    if (confirm("¿Realmente desea eliminar la Materia Prima?"))
      window.location.href = url;
    else
      return false;
  }
</script>

<?php



$fecha_actual = date("Y-m-d");
$hora = date("H:i:s", time() - 3600);
if (isset($_GET['eliminar'])) {
  $ci = $_GET["cod"];
  //datos que vienen del formulario             
  if ($ci == "") {
    echo "";
  } else {



    $ip = "{$_SERVER['REMOTE_ADDR']}";
    $puerto = "{$_SERVER['REMOTE_PORT']}";

    $sql = "INSERT INTO `bitacora` ( `fecha_movimientos`, `hora_movimiento`, `ip_ordenador`, `descripcion`, `usuarios_cedula`,`tipo`) VALUES ( '$fecha_actual', '$hora', '$ip', 'Se Elimino un  empleado con el n cedula " . $ci . " ', '$adminci', '2');";
    $bd->consulta($sql);



    //echo "Datos Guardados Correctamente";
    echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Bien!</b> Datos Eliminados Correctamente... ';

    echo '   </div>';

?>
<?php
  }
}


if (isset($_GET['eliminar'])) {

  $x1 = $_GET["codigo"];
  if ($x1 == "") {
    echo "<script> alert('campos vacios')</script>";
    echo "<br>";
  } else {
    $sql3 = "delete from `salida` where `salida`.`id_salida`='" . $x1 . "'";
    $bd->consulta($sql3);



    //echo "Datos Guardados Correctamente";
    echo '<div class="alert alert-success alert-dismissable">
                                                        <i class="fa fa-check"></i>
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <b>Bien!</b> Se Elimino Correctamente... </div>';
  }
}


if (isset($_GET['crear'])) {

  $service = utf8_decode($_POST['service']);
  $cantida = utf8_decode($_POST['cantida']);
  $fecha = utf8_decode($_POST['fecha']);
  $user = utf8_decode($_POST['user']);
  $motivo = utf8_decode($_POST['motivo']);
  $tippe = utf8_decode($_POST['tippe']);



  $resultado = str_replace("T", " ", $fecha);

  if ($fecha == "") {
    $resultado = $hoy = date("Y-m-d H:m:s");
  }


  if ($service == "") {

    echo "
                   <script> alert('campos vacios')</script>
                   ";
    echo "<br>";
  } else {

    //consultamos si existe

    $consulta = "SELECT * FROM `service` where id_service='$service'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {
      $totalactual = $fila->cantida;
      $costoactual = $fila->costo;
      $precioactual = $fila->price_service;
    }
    if ($costo == "")
      $costo = $costoactual;

    if ($salida == "")
      $salida = $precioactual;
    //suma de cantidad actual mas la nueva
    $grantotal = $totalactual - $cantida;
    if ($grantotal < 0) {
      echo '<div class="alert alert-danger alert-dismissable">
                                                    <i class="fa fa-times"></i>
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <b>Algo salio mal!</b> No existe ese stock... </div>';
    } else {
      $editar = "UPDATE `service` SET `cantida` = '$grantotal',`price_service` = '$salida',`costo` = '$costo' WHERE `service`.`id_service` = '$service'";
      $bd->consulta($editar);


      $sql = "INSERT INTO `salida` (`id_salida`, `id_service_id_salida`, `fecha_salida`, `id_user_id_salida`, `cantida_salida`, `motivo_salida`, `tipo_ser`) 
                                 VALUES (NULL,     '$service',            '$resultado',      '$user',              '$cantida',      '$motivo', 'Materia Prima')";
      $bd->consulta($sql);

      //echo "Datos Guardados Correctamente";
      echo '<div class="alert alert-success alert-dismissable">
                                                                    <i class="fa fa-check"></i>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <b>Bien!</b> Datos Registrados Correctamente... ';
      echo '   </div>';
    }
  }
}
?>
<div class="row">
  <div class="col-md-12">
    <a style=" margin-left: 10px;" title="Registrar Nuevo" class="btn red btn-outline sbold " data-toggle="modal" href="#productoguarda">Nueva Salida </a>
    <a style=" margin-left: 10px;" class="btn red btn-outline sbold " title="Actualizar tabla" data-toggle="modal" href="?mod=salidaM"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>

    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption font-dark">
          <i class="icon-arrow-up font-dark"></i>
          <span class="caption-subject bold uppercase">Registros de Salidas de Materia Prima</span>
          <a style=" margin-left: 10px;" title="ver listado" class="btn blue btn-outline sbold " data-toggle="modal" href="#verstock">Ver stock</a>
        </div>
        <div class="tools "> </div>
      </div>
      <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
          <thead>
            <tr>
              <th class="all hidden-print">#</th>
              <th class="min-phone-l">Materia Prima</th>
              <th class="min-phone-l">Cantida</th>
              <th class="min-phone-l">Fecha de Movimiento</th>
              <th class="min-phone-l hidden-print noimprimir"> Opciones</th>
              <th class="none">Responsable</th>
              <th class="none">Descripcion</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $consulta1 = "SELECT tipo_ser, MAX(cantida_salida) cantida_salida FROM salida GROUP by tipo_ser";
            $bd->consulta($consulta1);
            while ($fila1 = $bd->mostrar_registros()) { 
               if (($fila1->tipo_ser) == "Materia Prima") { 
                $jeje=$fila1->cantida_salida;
            }}

            $consulta = "SELECT * FROM `salida` INNER JOIN service ON salida.id_service_id_salida=service.id_service 
                                      INNER JOIN user ON salida.id_user_id_salida =user.id_user ";
            $bd->consulta($consulta);
            while ($fila = $bd->mostrar_registros()) { ?>
              <?php if (($fila->tipo_producto) == "Materia Prima") { ?>
                <tr>
                  <?php $id = $fila->id_salida; ?>

                  <td width="5%"><?php echo $fila->id_salida; ?></td>
                  <td width="25%"> <?php echo $fila->name_service; ?></td>
                  <?php if ($jeje==($fila->cantida_salida)){ ?>
                  <td width="25%" style="background-color:#C0FF52"><?php echo $fila->cantida_salida; ?>
                  <i class="fa fa-level-up" aria-hidden="true"></i>
                  </td>
                  <?php } else { ?>
                  <td width="25%"><?php echo $fila->cantida_salida; ?></td>
                  <?php } ?>
                  <td width="20%" ><?php echo $fila->fecha_salida; ?> </td>
                  <td width="25%" class="hidden-print noprin">
                    <center>


                      <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline " data-toggle="modal" href="#productover" title="ver" id="buttonHola" onclick="myFunction(this, '<?php echo $id ?>')"><i class='fa fa-eye'></i></a>
                      <a class="btn red btn-outline sbold " title="Eliminar" onclick='if(confirmDel() == false){return false;}' class="btn red btn-outline sbold" href='?mod=salidaM&eliminar&codigo=<?php echo $id ?>'><i class=' fa fa-trash'></i></a>


                    </center>
                  </td>
                  <td><?php echo $fila->name_user; ?></td>
                  <td><?php echo $fila->motivo_salida; ?></td>

                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script>
  var variableGlobal;

  function myFunction(elmnt, clr) {
    variableGlobal = clr;
    var idd = clr;
    console.log(variableGlobal);
    $.ajax({
      type: "GET",
      url: "api/salidas.php?tabla=1&idu=" + idd
    }).done(function(json) {
      json = $.parseJSON(json)
      for (var i = 0; i < json.length; i++) {
        $('.editinplace').html(
          "<div class='col-xs-8'><ul class='list-unstyled' style='line-height: 2'><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Codigo:</span> <span style='font-size: 9pt; text-align: left;'>" + json[i].id + "</span></li><li><span class='text-success'><i class='fa fa-desktop'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Materia Prima:</span> <span  data-campo='name_service' style='font-size: 9pt; text-align: left;'>" + json[i].nombre + "</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Cantidad:</span> <span style='font-size: 9pt; text-align: left;' data-campo='cantida_salida' >" + json[i].cantida + "</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Fecha:</span> <span style='font-size: 9pt; text-align: left;' data-campo='fecha_salida' >" + json[i].fecha + "</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Responsable:&nbsp; </span><span data-campo='name_user' >" + json[i].proveedor + "</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Descripcion  :&nbsp; </span><span data-campo='motivo_salida' >" + json[i].motivo + "</span></li></ul></div><div class='col-xs-4'><div class='well'><div style='color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;'></div><span style='font-size: 9pt; text-align: left;' data-campo='imagen' ><img width='100%' src='./producto/" + json[i].imagen + "'></span></br></div></div>");
      }

    });
  }
</script>

<?php

?>

<!--modal guardar nuevo -->
<div class="modal fade" id="productoguarda" tabindex="-1" role="basic" aria-hidden="true">
  <div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;">
          <h4><i class="glyphicon glyphicon-upload"></i>&nbsp; Registrar Nuevas Salida.</h4>
        </h2>
      </div>
      <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="portlet-body">
              <div class="table-scrollable">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <div id="register_form">
                        <form role="form" action="?mod=salidaM&crear=crear" method="post" enctype="multipart/form-data">
                          <th>Materia Prima </th>
                          <th>Cantidad</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td width="50%">
                        <?php
                        $consulta = "SELECT * FROM  service";
                        $bd->consulta($consulta); ?>
                        * <select class="form-control" name="service">
                          <?php
                          while ($fila = $bd->mostrar_registros()) { ?>
                            <?php if (($fila->tipo_producto) == "Materia Prima") { ?>
                              <option value="<?php echo $id = $fila->id_service; ?>">
                                <p><?php echo $id = $fila->name_service; ?></p>
                              </option>
                          <?php
                            }
                          }
                          ?>
                        </select>

                      </td>
                      <td>
                        * <input required type="number" required name="cantida" required class="form-control" min="1">
                      </td>
                      <td width="20%">
                      *<select  class="form-control"  >
                      <option>L</option>
                      <option>lb</option>
                      <option>kg</option>
                      <option>g</option>
                      </select>
                      </td>
                    </tr>
                  </tbody>
                  <thead>
                    <tr>
                      <th>Responsable</th>
                      <th></th>
                  </thead>
                  <tbody>
                  <input class="hidden" type="datetime-local" name="fecha" value="<?php echo $hoy ?>" />
                    <tr>
                      <td width="50%">
                        <center>
                          <?php
                          $consulta = "SELECT * FROM  user";
                          $bd->consulta($consulta); ?>
                          <select class="form-control" name="user">
                            <?php
                            while ($fila = $bd->mostrar_registros()) { ?>
                              <option value="<?php echo $id = $fila->id_user; ?>">
                                <p><?php echo $fila->name_user; ?></p>
                              </option>
                            <?php
                            }
                            ?>
                      </td>
                      <td>
                      <a class="btn green btn-outline sbold " href="/pastolac/admin/orden_salida.pdf" target="_blank">Orden de salida</a>
                      </td> 
                    </tr>
                  </tbody>

                  <thead>
                    <tr>

                      <th colspan="2">Descripcion</th>

                  </thead>
                  <tbody>
                    <tr>

                      <td colspan="2" width="100%">
                        <center>
                          <textarea class="form-control" name="motivo"></textarea>
                      </td>

                    </tr>
                  </tbody>
                  <tbody>
                  <input type="hidden" name="tippe" value="Materia Prima" />
                    <tr>

                      <td width="50%" colspan="2">
                        <center>
                          <center>
                            <button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Registrar</button>
                          </center>
                      </td>


                    </tr>
                  </tbody>
                  </form>
              </div>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>

<!--modal stock -->
<div class="modal fade" id="verstock" tabindex="-1" role="basic" aria-hidden="true">
  <div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;">
          <h4><i class="fa fa-eye"></i>&nbsp; Stock de Materia Prima.</h4>
        </h2>
      </div>
      <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
      <div class="modal-body">
        <div class="editinplace row">
          <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
              <tr>
                <th class="min-phone-l">Materia Prima</th>
                <th class="min-phone-l">Cantida</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $consulta = "SELECT * FROM `service`";
              $bd->consulta($consulta);
              while ($fila = $bd->mostrar_registros()) { ?>
                <?php if (($fila->tipo_producto) == "Materia Prima") { ?>
                  <tr>
                    <?php $id = $fila->id_salida; ?>
                    <td width="25%"> <?php echo $fila->name_service; ?></td>
                    <?php if (($fila->cantida)==0){?>
                    <td width="25%" style="background-color:#FF5252" > SIN STOCK</td>
                    <?php } else {?>
                      <td width="25%"><?php echo $fila->cantida; ?></td>
                    <?php } ?>
                  </tr>
              <?php
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
<!--modal editar -->
<div class="modal fade" id="productover" tabindex="-1" role="basic" aria-hidden="true">
  <div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;">
          <h4><i class="fa fa-eye"></i>&nbsp; Datos del Registro de salida.</h4>
        </h2>
      </div>
      <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
      <div class="modal-body">
        <div class="editinplace row">
        </div>
      </div>
    </div>
  </div>
</div>
<!--modal editar -->
<div class="modal fade" id="productoedita" tabindex="-1" role="basic" aria-hidden="true">
  <div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;">
          <h4><i class="fa fa-edit"></i>&nbsp; Editar Cuenta.</h4>
        </h2>
      </div>
      <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
      <div class="modal-body">
        <div class="editinplace2 row">


        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript" src="pages/jquery-1.10.2.min.js"></script>
</div>