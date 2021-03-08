<?php 
eliminarT($_GET['id_no']);
function eliminarT($id_no){
    include 'conexion.php';
    $sentencia="DELETE FROM listado WHERE id_no='".$id_no."' ";
    $conexion->query($sentencia) or die("Error al eliminar dato".mysqli_error($conexion));
}
header("Location: index.php?mod=MateriaPri#productoguarda");
?>
