<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idunidad_medida,nombre FROM unidad_medida
     WHERE idunidad_medida='$id' "; 

$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);