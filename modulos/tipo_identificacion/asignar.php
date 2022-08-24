<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idtipo_identificacion,
nombre 


FROM tipo_identificacion

     WHERE idtipo_identificacion='$id' "; 


$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);