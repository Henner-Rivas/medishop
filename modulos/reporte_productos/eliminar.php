<?php
require_once("conexion.php");

$idreporte_producto = $_POST['idreporte_producto'];

$sql = "DELETE FROM reporte_prodcuto WHERE idreporte_producto ='$idreporte_producto'";

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
