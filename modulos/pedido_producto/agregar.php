<?php
require_once("conexion.php");
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
if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}if ($cantidad == "") {
    $errores .= "<li>El campo 'cantidad' es obligatorio</li>";
}

          $sql = "INSERT INTO pedido_producto( fecha_vencimiento, idproducto, idpedido,cantidad) VALUES (
'$fecha_vencimiento',
'$idproducto',

'$idpedido','$cantidad')";


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