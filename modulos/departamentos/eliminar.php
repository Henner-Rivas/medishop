<?php
require_once("conexion.php");

$iddepartamento=$_POST['iddepartamento'];

$sql = "DELETE FROM departamento WHERE iddepartamento ='$iddepartamento'";

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
