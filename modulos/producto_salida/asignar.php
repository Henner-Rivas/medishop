<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idproducto_salida,

producto.idproducto,
salida.idsalida,
cantidad as cantidad
FROM producto_salida
join producto on producto_salida.idproducto=producto.idproducto
join salida on producto_salida.idsalida=salida.idsalida


     WHERE idproducto_salida='$id' "; 

   



$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);