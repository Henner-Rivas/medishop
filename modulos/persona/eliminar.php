<?php
require_once("conexion.php");

$persona_id = $_POST['idpersona'];

$sql = "DELETE FROM  persona WHERE idpersona ='$persona_id'";

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
