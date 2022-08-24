<?php
require_once("conexion.php");

$idpedido_producto = $_POST['idpedido_producto'];

$sql = "DELETE FROM  pedido_producto WHERE idpedido_producto ='$idpedido_producto'";

mysqli_query($conexion, $sql);
$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "Registro eliminado con éxito.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] = mysqli_error($conexion);
}
echo json_encode($respuesta);