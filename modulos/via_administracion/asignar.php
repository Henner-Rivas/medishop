<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idvia_administracion,nombre FROM via_administracion
     WHERE idvia_administracion='$id' "; 

$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);