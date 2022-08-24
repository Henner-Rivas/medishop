<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idpedido,
fecha_pedido,
idproveedor
FROM pedido

     WHERE idpedido='$id' "; 


$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);