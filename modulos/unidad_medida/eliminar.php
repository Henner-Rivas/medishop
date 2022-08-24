<?php
require_once("conexion.php");

$idunidad_medida = $_POST['idunidad_medida'];

$sql = "DELETE FROM unidad_medida WHERE idunidad_medida ='$idunidad_medida'";

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
