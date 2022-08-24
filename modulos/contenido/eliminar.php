<?php
require_once("conexion.php");

$contenido_id = $_POST['contenido_id'];

$sql = "DELETE FROM  contenido WHERE contenido_id ='$contenido_id'";

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
