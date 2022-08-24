<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT `idproducto_reporte_vencimiento`, 
 producto.codigo,producto.idproducto,
persona.idpersona,
persona.identificacion,
reporte_vencimiento.idreporte_vencimiento,
producto_reporte_vencimiento.fecha_vencimiento,
producto_reporte_vencimiento.cantidad
 FROM `producto_reporte_vencimiento` 

JOIN producto on producto_reporte_vencimiento.idproducto= producto.idproducto
JOIN reporte_vencimiento on producto_reporte_vencimiento.idreporte_vencimiento =
reporte_vencimiento.idreporte_vencimiento
JOIN empleado on reporte_vencimiento.idempleado= empleado.idempleado
JOIN persona ON empleado.idpersona=persona.idpersona
           
             WHERE idproducto_reporte_vencimiento='$id' "; 


    



$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);