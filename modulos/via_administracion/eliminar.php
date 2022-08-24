<?php
require_once("conexion.php");

$idvia_administracion = $_POST['idvia_administracion'];

$sql = "DELETE FROM via_administracion WHERE idvia_administracion ='$idvia_administracion'";

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
