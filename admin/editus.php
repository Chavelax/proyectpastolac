<?php
$consulta=ConsultarUsu($_GET['id_user']);
function ConsultarUsu($id_userr){
    include 'conexion.php';
    $sentencia="SELECT *FROM user where id_user='".$id_userr."' ";
    $resultado= $conexion->query($sentencia) or die ("Error al consultar".mysqli_error($conexion));
    $fila=$resultado->fetch_assoc();
    return[
        $fila['id_user'],
        $fila['name_user'],
        $fila['last_name_user'],
        $fila['mail_user'],
        $fila['phone_user'],
        $fila['ci_user'],
        $fila['pw_user'],
        $fila['direccion']

    ];
}
?>

              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                         <a href="?admin=usuario"><button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">×</span><span class="sr-only">Close</span></button></a>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-edit"></i>&nbsp; Editar usuario.</h4></h2>
                      </div>
                  <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
                    <div class="modal-body">
                        <div class="">
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
                                    <form  role="form" action="?admin=editusu" method="post" enctype="multipart/form-data">              
                                                        <th>Nombre </th>
                                                        <th>Apellido </th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%">
                                    <input type="hidden" name="id_usrr" value="<?php echo $consulta[0] ?>" />
                                   <input class="form-control"  type="text" name="name_usrr" value="<?php echo $consulta[1] ?>" />
                                    </select>
                                       
                                    </td>
                                    <td >
                                      <input  class="form-control"  type="text" name="last_name_usrr" value="<?php echo $consulta[2] ?>" />
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
                                    <input  class="form-control"  type="text" name="mail_usrr" value="<?php echo $consulta[3] ?>" />
                                    </td>
                                    <td width="50%" ><center>
                                    <input  class="form-control"  type="number" name="phone_usrr" value="<?php echo $consulta[4] ?>" />
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
                                        <input class="form-control" type="number" name="ci_usrr" value="<?php echo $consulta[5] ?>" />
                                    </td>
                                    <td width="50%"><center>
                                    <input  class="form-control"  type="text" name="pw_usrr" value="<?php echo $consulta[6] ?>" />
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
                                   <input class="form-control" name="direccion_usrr" value="<?php echo $consulta[7] ?>" ></input>
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr> 
                                    <td width="50%" colspan="2"><center>
                                     <center>
                                       <button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Editar usuario</button></center>
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
        </div>
        </div>