<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idreporte_producto,
cantidad_actual as cantidad_actual,

producto.idproducto,
empleado.idempleado
FROM reporte_prodcuto
join empleado on reporte_prodcuto.idempleado=empleado.idempleado
 join persona on empleado.idpersona=persona.idpersona
 join cargo on empleado.idcargo=cargo.idcargo
 join producto on reporte_prodcuto.idproducto=producto.idproducto


     WHERE idreporte_producto='$id' "; 

    // $sql = "SELECT 
    // idpedido_producto,
    // codigo as codigo_producto, 
    // nombre as nombre_producto,
    // valor_unitario,  
    // descripcion,
    // fecha_vencimiento,
    // fecha_pedido,
    // idunidad_medida,
    // idvia_administracion,
    // idpresentacion, 
    // iva,
    // cantidad,
    // nombre ,
    // apellidos,
    // identificacion,
    // tipo_identificacion_id,
    // direccion,
    // email,
    // telefono 
    // FROM pedido_producto
    // WHERE idpedido_producto='$id'";



$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);