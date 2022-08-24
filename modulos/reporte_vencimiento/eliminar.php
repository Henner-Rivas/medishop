<?php
require_once("conexion.php");

$idreporte_vencimiento = $_POST['idreporte_vencimiento'];

$sql = "DELETE FROM reporte_vencimiento WHERE idreporte_vencimiento ='$idreporte_vencimiento'";

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
