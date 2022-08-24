<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "
SELECT `idcargo`, `nombre` as cargo FROM `cargo` 
where idcargo='$id'
     "; 





$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);