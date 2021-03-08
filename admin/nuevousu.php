<?php
NuevoUsuario($_POST['id_us'],$_POST['name_us'],$_POST['last_name_us'],$_POST['mail_us'],$_POST['phone_us'],$_POST['ci_us'],$_POST['pw_us'],$_POST['direccion_us']);
function NuevoUsuario($id,$nomb,$apell,$emai,$telef,$ced,$contr,$dire)
{
    include 'conexion.php';
    echo $sentencia="INSERT INTO user (id_user,name_user,last_name_user,mail_user,phone_user,ci_user,pw_user,direccion) VALUES ('".$id."','".$nomb."','".$apell."','".$emai."','".$telef."','".$ced."','".$contr."','".$dire."')";
    $conexion->query($sentencia) or die("Error al ingresar dato".mysqli_error($conexion));
}
header("Location: indexadmin.php?admin=usuario");
?>
