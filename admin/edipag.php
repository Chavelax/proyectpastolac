<?php
$consulta=ConsultarUsu($_GET['id_pag']);
function ConsultarUsu($id_pagg){
    include 'conexion.php';
    $sentencia="SELECT *FROM pagina where id_pag='".$id_pagg."' ";
    $resultado= $conexion->query($sentencia) or die ("Error al consultar".mysqli_error($conexion));
    $fila=$resultado->fetch_assoc();
    return[
        $fila['id_pag'],
        $fila['nombre_pag'],
        $fila['descrip_pag'],
        $fila['precio_pag'],
        $fila['imagen']

    ];
}
?>

              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                         <a href="?admin=pag"><button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">×</span><span class="sr-only">Close</span></button></a>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-edit"></i>&nbsp; Editar producto web.</h4></h2>
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
                                    <form  role="form" action="?admin=editpag" method="post" enctype="multipart/form-data">              
                                                        <th>Nombre </th>
                                                        <th>Precio </th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%">
                                    <input type="hidden" name="id_pagg" value="<?php echo $consulta[0] ?>" />
                                   <input class="form-control"  type="text" required name="name_pag" value="<?php echo $consulta[1] ?>" />
                                    </select>
                                       
                                    </td>
                                    <td >
                                      <input  class="form-control"  type="text" required name="precio_pagg" value="<?php echo $consulta[3] ?>" />
                                    </td>
                                  </tr>
                                 <thead>
                                  <tr>
                                               
                                                        <th colspan="2">Descripcion</th>
                                                        
                                </thead>
                                <tbody>
                                  <tr> 
                                    
                                    <td colspan="2" width="100%"><center>
                                   <input class="form-control" required name="descrip_pagg" value="<?php echo $consulta[2] ?>" ></input>
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                <input class="form-control" required type="file" name="img_pa">

                                <tbody>
                                  <tr> 
                                    <td width="50%" colspan="2"><center>
                                     <center>
                                       <button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Editar producto web</button></center>
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