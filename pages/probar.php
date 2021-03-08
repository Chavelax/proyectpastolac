<link href="assets/fileinput.css" media="all" rel="stylesheet" type="text/css" />

<script src="assets/fileinput.js" type="text/javascript"></script>


<div class="row">
  <div class="col-md-12">
    <a style=" margin-left: 10px;" title="Registrar Nuevo" class="btn red btn-outline sbold " data-toggle="modal" href="#productoguarda">Nuevo </a>
    <a style=" margin-left: 10px;" class="btn red btn-outline sbold " title="Actualizar tabla" data-toggle="modal" href="?admin=MateriaPri"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption font-dark">
          <i class="icon-settings font-dark"></i>
          <span class="caption-subject bold uppercase">Lista De Materia Prima</span>
        </div>
        <div class="tools "> </div>
      </div>
      <div class="portlet-body">
        
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr>
                <th class="all hidden-print">#</th>
                <th class="min-phone-l">Nombre</th>
                <th class="min-phone-l">Costo</th>
                <th class="min-phone-l">cantidad</th>
                <th class="min-phone-l"> Opciones</th>
                <th class="none">informacion </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $consulta = "SELECT * FROM `service` ORDER by id_service DESC";
                $bd->consulta($consulta);
                while ($fila = $bd->mostrar_registros()) { ?>
                <?php if(($fila->tipo_producto)=="Materia Prima"){ ?>
                <tr>
                    <?php $id = $fila->id_service; ?>
                    <td width="5%"><?php echo $fila->id_service; ?></td>
                    <td width="25%"><?php echo $fila->name_service; ?></td>
                    <td width="25%"><?php echo $fila->costo; ?></td>
                    <td width="20%"> <?php echo $fila->cantida; ?> </td>
                    <td width="25%">
                    <center>
                        <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline " data-toggle="modal" href="#productoedita" title="editar" id="buttonHola" onclick="myFunction2(this, '<?php echo $id ?>')"><i class='fa fa-edit'></i> </a>
                        <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline  " data-toggle="modal" title="Ver" href="#productover" id="buttonHola" onclick="myFunction(this, '<?php echo $id ?>')"><i class='fa fa-eye'></i></a>
                        <!--  <a class="dt-button buttons-pdf cargar buttons-html5 btn blue btn-outline " data-toggle="modal"  title="Cargar imagen" href="#imagenprin1<?php echo $id  ?>"><i class='fa fa-file-image-o'></i></a> -->
                        <a class="btn red btn-outline sbold derecha" title="Eliminar" onclick='if(confirmDel() == false){return false;}' class="btn red btn-outline sbold" href='?admin=productos&eliminar&codigo=<?php echo $id ?>'><i class=' fa fa-trash'></i></a>

                    </center>
                    </td>
                    <td><?php echo $fila->info_service; ?></td>
                </tr>
                <div class="modal fade" id="imagenprin1<?php echo $id  ?>" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Editar imagen del Submodulo: <?php echo  $fila->name_service; ?></h4>
                        </div>

                        <div class="modal-footer">

                        <input id="perfil1<?php echo  $id ?>" name="imagenprin[]" type="file" multiple class="file-loading">
                        <script type="text/javascript">
                            $("#perfil1<?php echo  $id ?>").fileinput({
                            uploadUrl: "admin/guardaproyecto.php?codigo=<?php echo  $id ?>", // server upload action
                            uploadAsync: true,
                            maxFileCount: 1,
                            showBrowse: false,
                            browseOnZoneClick: true
                            });
                        </script>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <?php
                }}
                ?>
            </tbody>
            </table>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="pages/jquery-1.10.2.min.js"></script>

</div>
<link href="assets/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="assets/fileinput.js" type="text/javascript"></script>