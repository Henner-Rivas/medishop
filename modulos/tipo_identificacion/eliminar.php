<?php
require_once("conexion.php");

$idtipo_identificacion = $_POST['idtipo_identificacion'];

$sql = "DELETE FROM tipo_identificacion WHERE idtipo_identificacion ='$idtipo_identificacion'";

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
