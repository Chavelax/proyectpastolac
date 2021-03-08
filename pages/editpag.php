<?php

ModificarUsu($_POST['id_pagg'],$_POST['name_pag'],$_POST['precio_pagg'],$_POST['descrip_pagg'],$_POST['img_pa']);

 function ModificarUsu($id_pag,$nam,$prec,$desc,$imgg)
 {
   $imgg=$_FILES["img_pa"]["name"];
   $ruta=$_FILES["img_pa"]["tmp_name"];
   $destino="producto/".$imgg;
   copy($ruta,$destino);
    include 'conexion.php';
    echo $sentencia="UPDATE pagina set nombre_pag='".$nam."', descrip_pag='".$desc."', precio_pag='".$prec."', imagen='".$imgg."' where id_pag='".$id_pag."' " ;
    $conexion->query($sentencia) or die("Error al actualizar dato".mysqli_error($conexion));
    
 }
 header("Location: indexadmin.php?admin=pag");
    
?>
