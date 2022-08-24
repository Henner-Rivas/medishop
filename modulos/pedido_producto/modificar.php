<?php
require_once("conexion.php");
$idpedido_producto = $_POST['idpedido_producto'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$idproducto = $_POST['idproducto'];
$idpedido = $_POST['idpedido'];
$cantidad = $_POST['cantidad'];


$errores = "";
$respuesta = [];

if ($idproducto == "") {
    $errores .= "<li>El campo 'Producto' es obligatorio</li>";
}

if ($fecha_vencimiento == "") {
    $errores .= "<li>El campo 'Fecha de vencimiento' es obligatorio</li>";
}
if ($idpedido == "") {
    $errores .= "<li>El campo 'Fecha del pedido' es obligatorio</li>";
}
if ($cantidad == "") {
    $errores .= "<li>El campo 'cantidad' es obligatorio</li>";
}
if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}

        $sql = "UPDATE pedido_producto
set
idpedido='$idpedido',
idproducto='$idproducto',

fecha_vencimiento='$fecha_vencimiento',
cantidad='$cantidad'


where idpedido_producto=$idpedido_producto


";

mysqli_query($conexion, $sql);

              
             
$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "Registro guardado con éxito.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] = mysqli_error($conexion);
}
echo json_encode($respuesta);
