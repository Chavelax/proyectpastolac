<?php
NuevoUsuario($_POST['namer'],$_POST['tipor']);

function NuevoUsuario($nomb,$tip)
{
    include 'conexion.php';
    echo $sentencia="INSERT INTO listado (id_no,name_no,tipe) VALUES (NULL,'".$nomb."','".$tip."')";
    $conexion->query($sentencia) or die("Error al ingresar dato".mysqli_error($conexion));
}
header("Location: indexadmin.php?admin=productos#productoguarda");
?>
