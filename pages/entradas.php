<style type="text/css">
  @media print {
    .noimprimir {
      font-size: 10pt
    }
  }
</style>




<script LANGUAGE="JavaScript">
  function confirmDel(url) {
    //var agree = confirm("¿Realmente desea eliminarlo?");
    if (confirm("¿Realmente desea eliminar?"))
      window.location.href = url;
    else
      return false;
  }
</script>

<?php



$fecha_actual = date("Y-m-d");
$hora = date("H:i:s", time() - 3600);
$fecc = date("d") + 5;
$fechaC = date("Y-m-") . $fecc;

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
    $sql3 = "delete from `ingresos` where `ingresos`.`id_ingreso`='" . $x1 . "'";
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
  $costo = utf8_decode($_POST['costo']);
  $fecha = utf8_decode($_POST['fecha']);
  $salida = utf8_decode($_POST['salida']);
  $proveedor = utf8_decode($_POST['proveedor']);
  $motivo = utf8_decode($_POST['motivo']);
  $fechaentra = utf8_decode($_POST['fechaentra']);
  $fechavence = utf8_decode($_POST['fechavence']);




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
    $grantotal = $totalactual + $cantida;

    if($grantotal<0){
      echo '<div class="alert alert-alert alert-dismissable">
      <i class="fa fa-times"></i>
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <b>Algo salio mal!</b> </div>';
    }else{

    $editar = "UPDATE `service` SET `cantida` = '$grantotal',`price_service` = '$salida',`costo` = '$costo' WHERE `service`.`id_service` = '$service'";
    $bd->consulta($editar);


    $sql = "INSERT INTO `ingresos` (`id_ingreso`, `id_service_id_ingreso`, `fecha_ingreso`, `id_proveedor_id_ingreso`, `cantida_movimiento`, `motivo`, `fecha_entrada`, `fecha_venci`) VALUES (NULL,'$service','$resultado','$proveedor','$cantida','$motivo', '$fechaentra', '$fechavence')";
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
    <a style=" margin-left: 10px;" title="Registrar Nuevo" class="btn red btn-outline sbold " data-toggle="modal" href="#productoguarda">Nuevo ingreso de Productos </a>

    <a style=" margin-left: 10px;" class="btn red btn-outline sbold " title="Actualizar tabla" data-toggle="modal" href="?mod=entradas"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>

    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption font-dark">
          <i class="icon-settings font-dark"></i>
          <span class="caption-subject bold uppercase">Registros de entrada de Productos</span>

        </div>

        <div class="tools "> </div>

      </div>

      <div class="portlet-body">

        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
          <thead>
            <tr>
              <th class="all hidden-print">#</th>
              <th class="min-phone-l">Materia</th>
              <th class="min-phone-l">Cantidad</th>
              <th class="min-phone-l">Fecha de Entrada</th>
              <th class="min-phone-l">Fecha de Vencimiento</th>
              <th class="min-phone-l hidden-print noimprimir"> Opciones</th>
              <th class="none">Nuevo Precio</th>
              <th class="none">Fecha de Movimiento</th>
              <th class="none">Descripcion</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $consulta = "SELECT * FROM `ingresos` INNER JOIN service ON ingresos.id_service_id_ingreso=service.id_service 
                                        INNER JOIN proveedor ON ingresos.id_proveedor_id_ingreso=proveedor.id_proveedor  ";
            $bd->consulta($consulta);
            while ($fila = $bd->mostrar_registros()) { ?>
              <?php if (($fila->tipo_producto) == "Producto Elaborado") { ?>

                <tr>
                  <?php $id = $fila->id_ingreso; ?>

                  <td width="5%"><?php echo $fila->id_ingreso; ?></td>
                  <td width="25%"> <?php echo $fila->name_service; ?></td>
                  <td width="25%"><?php echo $fila->cantida_movimiento; ?></td>
                  <td width="20%"><?php echo $fila->fecha_entrada; ?> </td>
                  <?php if($fecha_actual>($fila->fecha_venci)) {?>
                  <td width="20%" style="background-color:#FF5252"><?php echo $fila->fecha_venci; ?> 
                  <i class="fa fa-calendar-times-o" aria-hidden="true">Caduco</i>
                  </td>
                  <?php }else if(($fila->fecha_entrada)<($fila->fecha_venci)) {?>
                    <td width="20%" style="background-color:#FFFC52"><?php echo $fila->fecha_venci; ?> 
                    <i class="fa fa-calendar-minus-o" aria-hidden="true">Proximo a caducar</i></td>
                  <?php }else{ ?>
                    <td width="20%" style="background-color:#C0FF52"><?php echo $fila->fecha_venci; ?> 
                    <i class="fa fa-calendar-check-o" aria-hidden="true">Buen estado</i></td>
                  <?php } ?>
                  <td width="25%" class="hidden-print noprin">
                    <center>


                      <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline " data-toggle="modal" href="#productover" title="ver" id="buttonHola" onclick="myFunction(this, '<?php echo $id ?>')"><i class='fa fa-eye'></i></a>
                      <a class="btn red btn-outline sbold " title="Eliminar" onclick='if(confirmDel() == false){return false;}' class="btn red btn-outline sbold" href='?mod=entradaM&eliminar&codigo=<?php echo $id ?>'><i class=' fa fa-trash'></i></a>


                    </center>
                  </td>
                  <td><?php echo $fila->price_service; ?></td>
                  <td><?php echo $fila->fecha_ingreso; ?> </td>
                  <td><?php echo $fila->motivo; ?></td>


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
      url: "api/entradas.php?tabla=1&idu=" + idd
    }).done(function(json) {
      json = $.parseJSON(json)
      for (var i = 0; i < json.length; i++) {
        $('.editinplace').html(
          "<div class='col-xs-8'><ul class='list-unstyled' style='line-height: 2'><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Codigo:</span> <span style='font-size: 9pt; text-align: left;'>" + json[i].id + "</span></li><li><span class='text-success'><i class='fa fa-desktop'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Producto o servicio:</span> <span  data-campo='name_service' style='font-size: 9pt; text-align: left;'>" + json[i].nombre + "</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Cantidad:</span> <span style='font-size: 9pt; text-align: left;' data-campo='cantida_movimiento' >" + json[i].cantida + "</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Fecha:</span> <span style='font-size: 9pt; text-align: left;' data-campo='fecha_ingreso' >" + json[i].fecha + "</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Descripcion:&nbsp; </span><span data-campo='motivo' >" + json[i].motivo + "</span></li></ul></div><div class='col-xs-4'><div class='well'><div style='color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;'></div><span style='font-size: 9pt; text-align: left;' data-campo='imagen' ><img width='100%' src='./producto/" + json[i].imagen + "'></span></br></div></div>");
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
          <h4><i class="fa fa-plus-square-o"></i>&nbsp; Registrar Nuevas Entrada.</h4>
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
                        <form role="form" action="?mod=entradas&crear=crear" method="post" enctype="multipart/form-data">
                          <th>Producto</th>
                          <th>Cantidad </th>
                          <th> </th>
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
                            <?php if (($fila->tipo_producto) == "Producto Elaborado") { ?>
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
                        * <input required type="number" required name="cantida" required class="form-control" min="1" max="200" >
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
                      <th>Nuevo Precio</th>
                      <th>Fecha de entrada</th>
                  </thead>
                  <tbody>
                  <input class="hidden" type="datetime-local" name="fecha" />
                  <td width="50%">
                        <center>
                          <input class="form-control" type="text" name="salida" placeholder="campo no requerido" />
                      </td>
                      <td width="50%">
                        <center>
                          <input class="form-control" type="date" name="fechaentra" value="<?php echo $fecha_actual; ?>" min="<?php echo $fecha_actual; ?>" max="<?php echo $fecha_actual; ?>" />
                      </td>
                    <tr>
                    
                    </tr>
                  </tbody>
                  <thead>
                    <tr>
                      <th>Fecha de vencimiento</th>
                      <th></th>
                  </thead>
                  <tbody>
                    <input class="hidden" name="proveedor" value="1" />
                      <td>
                        <input class="form-control" required type="date" name="fechavence" min="<?php echo $fechaC; ?>" />
                      </td>
                      <td>
                      <a class="btn green btn-outline sbold " href="/pastolac/admin/orden_entrada.pdf" target="_blank">Orden de Entrada</a>
                      </td>
                    </tr>
                  </tbody>
                  <thead>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
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

<!--  modal de nuevo deposito eectivo-->


<!--modal editar -->
<div class="modal fade" id="productover" tabindex="-1" role="basic" aria-hidden="true">
  <div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;">
          <h4><i class="fa fa-eye"></i>&nbsp; Datos del Registro de entrada.</h4>
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