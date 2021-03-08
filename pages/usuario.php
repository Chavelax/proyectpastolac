<style type="text/css">
  @media print {
   .noimprimir{
    font-size: 10pt
  }
}

</style>

<?php 
if (isset($_GET['eliminar'])) { 

  $x1=$_GET["codigo"];                    
 if( $x1=="" ){
     echo "<script> alert('campos vacios')</script>";
     echo "<br>";
 }else{
                 $sql3="delete from `user` where `user`.`id_user`='".$x1."'";
                 $bd->consulta($sql3);
                

    
                             //echo "Datos Guardados Correctamente";
                             echo '<div class="alert alert-success alert-dismissable">
                                         <i class="fa fa-check"></i>
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                         <b>Bien!</b> Se Elimino Correctamente... </div>';
     }
}
?>


<script LANGUAGE="JavaScript">
function confirmDel(url){
//var agree = confirm("¿Realmente desea eliminarlo?");
if (confirm("¿Realmente desea eliminar?"))
    window.location.href = url;
else
    return false ;
}
</script>


                    <div class="row">
                        <div class="col-md-12">
                          <a style=" margin-left: 10px;"  title="Registrar Nuevo" class="btn red btn-outline sbold " data-toggle="modal" href="#productoguarda">Nuevo Usuario</a> 
                 
                          <a style=" margin-left: 10px;" class="btn red btn-outline sbold " title="Actualizar tabla" data-toggle="modal" href="?admin=usuario"> <i class="fa fa-refresh" aria-hidden="true"></i> </a> 

                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-user font-dark"></i>
                                        <span class="caption-subject bold uppercase">Usuarios</span>
                                       
                                    </div>

                                    <div class="tools "> </div>
                                    
                                </div>
                                <div class="portlet-body">

                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th  class="all hidden-print">#</th>
                                                <th class="min-phone-l">Nombre</th>
                                                <th class="min-phone-l">Apellido</th>
                                                <th class="min-phone-l">Usuario/mail</th>
                                                <th  class="min-phone-l hidden-print noimprimir"> Opciones</th>
                                                <th class="none">Cedula</th>
                                                <th class="none">Contraseña</th>
                                                <th class="none">Telefono</th>
                                                <th class="none">Direccion</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                     $consulta="SELECT * FROM `user` ";
                                         $bd->consulta($consulta);
                                      while ($fila=$bd->mostrar_registros()) { ?>
                                        <tr>    
                                        <?php $id= $fila->id_user; ?>

                                             <td  width="5%"><?php echo $fila->id_user; ?></td>
                                             <td  width="25%"> <?php echo $fila->name_user; ?></td>
                                             <td  width="25%"> <?php echo $fila->last_name_user; ?></td>
                                             <td  width="20%"><?php echo $fila->mail_user; ?>  </td>
                                             <td width="25%" class="hidden-print noprin">
                                                <center>
                                                <?php echo " 
                                                <a class='dt-button buttons-pdf buttons-html5 btn blue btn-outline ' data-toggle='modal' href='?admin=editus&id_user=".$fila->id_user."' title='editar' id='buttonHola' ><i class='fa fa-edit' ></i> </a>";?>
                                                <a  class="btn red btn-outline sbold "  title="Eliminar" onclick='if(confirmDel() == false){return false;}' class="btn red btn-outline sbold"  href='?admin=usuario&eliminar&codigo=<?php echo $id ?>'><i class=' fa fa-trash'></i></a>

                                                </center> 
                                             </td>
                                             <td><?php echo $fila->ci_user ; ?></td>
                                             <td><?php echo $fila->pw_user; ?></td>
                                             <td><?php echo $fila->phone_user; ?></td>
                                              <td><?php echo $fila->direccion; ?></td>
                                        </tr>
                                          <?php 
                                           }
                                           ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<!--modal guardar nuevo -->
        <div class="modal fade" id="productoguarda" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-plus-square-o"></i>&nbsp; Registrar Nuevo usuario.</h4></h2>
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
                                    <form  role="form" action="?admin=nuevousu&NuevoUsuario=NuevoUsuario" method="post" enctype="multipart/form-data">              
                                                        <th>Nombre </th>
                                                        <th>Apellido </th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%">
                                    <!-- Nombre -->
                                    <input type="hidden" name="id_us" >
                                   <input class="form-control" required type="text" name="name_us" />
                                    </select>
                                       
                                    </td>
                                    <td >
                                      <input  class="form-control" required type="text" name="last_name_us" />
                                    </td>
                                  </tr>
                                </tbody>
                                <thead>
                                  <tr>
                                                        <th>Usuario/email</th>
                                                        <th>Telefono</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%">
                                    <input  class="form-control" required type="text" name="mail_us" />
                                    </td>
                                    <td width="50%" ><center>
                                    <input  class="form-control"  type="text" name="phone_us" />
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                <thead>
                                  <tr>
                                               
                                                        <th>Cedula</th>
                                                        <th>Contraseña</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%"><center>
                                        <input class="form-control" type="number" name="ci_us" />
                                    </td>
                                    <td width="50%"><center>
                                    <input  class="form-control" required type="password" name="pw_us" />
                                    </td>
                                    
                                  </tr>
                                </tbody>

                                 <thead>
                                  <tr>
                                               
                                                        <th colspan="2">Direccion</th>
                                                        
                                </thead>
                                <tbody>
                                  <tr> 
                                    
                                    <td colspan="2" width="100%"><center>
                                   <textarea class="form-control" name="direccion_us"></textarea>
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr> 
                                    <td width="50%" colspan="2"><center>
                                     <center>
                                       <button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Registrar usuario</button></center>
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
    
  <script type="text/javascript" src="pages/jquery-1.10.2.min.js"></script>
</div>
