<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idsalida,fecha FROM salida
     WHERE idsalida='$id' "; 

$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);