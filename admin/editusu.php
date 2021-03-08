<?php

ModificarUsu($_POST['id_usrr'],$_POST['name_usrr'],$_POST['last_name_usrr'],$_POST['mail_usrr'],$_POST['phone_usrr'],$_POST['ci_usrr'],$_POST['pw_usrr'],$_POST['direccion_usrr']);

 function ModificarUsu($id_user,$name,$apell,$ema,$telef,$ced,$con,$dire)
 {
    include 'conexion.php';
    echo $sentencia="UPDATE user set name_user='".$name."', last_name_user='".$apell."', mail_user='".$ema."', phone_user='".$telef."', ci_user='".$ced."', pw_user='".$con."', direccion='".$dire."' where id_user='".$id_user."' " ;
    $conexion->query($sentencia) or die("Error al actualizar dato".mysqli_error($conexion));
    
 }
    header("Location: indexadmin.php?admin=usuario");
    
?>


