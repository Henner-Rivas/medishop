<?php
require_once("conexion.php");
$idpedido = $_POST['idpedido'];
$fecha_pedido = $_POST['fecha_pedido'];
$idproveedor = $_POST['idproveedor'];

$errores = "";
$respuesta = [];

if ($fecha_pedido == "") {
    $errores .= "<li>El campo 'Fecha de pedido' es obligatorio</li>";
}

if ($idproveedor == "") {
    $errores .= "<li>El campo 'Proveedor' es obligatorio</li>";
}
if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}

          $sql = "INSERT INTO pedido (fecha_pedido, idproveedor) VALUES ('$fecha_pedido', '$idproveedor')";
        
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
