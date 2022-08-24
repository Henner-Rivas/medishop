<?php
require_once("conexion.php");

$idproducto_reporte_vencimiento = $_POST['idproducto_reporte_vencimiento'];

$sql = "DELETE FROM producto_reporte_vencimiento WHERE idproducto_reporte_vencimiento ='$idproducto_reporte_vencimiento'";

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
