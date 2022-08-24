<?php
require_once("conexion.php");
$idunidad_medida = $_POST['idunidad_medida'];
$nombre = $_POST['nombre'];


$errores = "";
$respuesta = [];

if ($nombre == "") {
    $errores .= "<li>El campo 'Unidad de medida' es obligatorio</li>";
}




if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "UPDATE unidad_medida

set
nombre='$nombre'

where idunidad_medida=$idunidad_medida";


mysqli_query($conexion, $sql);

$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "Registro editado con éxito.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] = mysqli_error($conexion);
}
echo json_encode($respuesta);
