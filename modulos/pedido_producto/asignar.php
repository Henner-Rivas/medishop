<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idpedido_producto,
fecha_vencimiento as fecha_vencimiento,
cantidad,
proveedor.idproveedor,
producto.idproducto,
pedido.idpedido



FROM pedido_producto
join pedido on pedido_producto.idpedido=pedido.idpedido
  join producto on pedido_producto.idproducto=producto.idproducto
join proveedor on pedido.idproveedor=proveedor.idproveedor
  join persona on proveedor.idpersona=persona.idpersona
  
     WHERE idpedido_producto='$id' "; 



$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);