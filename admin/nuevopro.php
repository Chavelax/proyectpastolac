<?php
NuevoUsuario($_POST['id_pa'],$_POST['name_pag'],$_POST['precio_pa'],$_POST['descripcion_pa'],$_POST['img_pa']);

function NuevoUsuario($id,$nomb,$prec,$des,$imge)
{
    $imge=$_FILES["img_pa"]["name"];
    $ruta=$_FILES["img_pa"]["tmp_name"];
    $destino="producto/".$imge;
    copy($ruta,$destino);
    include 'conexion.php';
    echo $sentencia="INSERT INTO pagina (id_pag,nombre_pag,descrip_pag,precio_pag,imagen) VALUES ('".$id."','".$nomb."','".$des."','".$prec."','".$imge."')";
    $conexion->query($sentencia) or die("Error al ingresar dato".mysqli_error($conexion));
}

header("Location: indexadmin.php?admin=pag");
?>
