<?php
$user="root";
$pass="";
$server="localhost";
$db="pastolac";
$port="3306";
$conexion=new mysqli($server,$user,$pass,$db,$port);

if($conexion->connect_errno){
    //echo "No conectado";
}else{

   // echo "Conectado";
}
?>