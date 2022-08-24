<?php
require_once("conexion.php");
$idsalida = $_POST['idsalida'];
$fecha = $_POST['fecha'];


$errores = "";
$respuesta = [];

if ($fecha == "") {
    $errores .= "<li>El campo 'Fecha' es obligatorio</li>";
}




if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "UPDATE salida

set
fecha='$fecha'

where idsalida=$idsalida";


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
