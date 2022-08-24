<?php
require_once("conexion.php");

$idreporte_vencimiento = $_POST['idreporte_vencimiento'];
$idproducto= $_POST['idproducto'];
$fecha_vencimiento= $_POST['fecha_vencimiento'];
$cantidad = $_POST['cantidad'];



$errores = "";
$respuesta = [];


if ($idreporte_vencimiento == "") {
    $errores .= "<li>El campo 'Empleado' es obligatorio</li>";
}

if ($idproducto == "") {
    $errores .= "<li>El campo 'producto' es obligatorio</li>";
}
if ($fecha_vencimiento == "") {
    $errores .= "<li>El campo 'fecha vencimiento' es obligatorio</li>";
}

if ($cantidad == "") {
    $errores .= "<li>El campo 'cantidad' es obligatorio</li>";
}


if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}

$sql = "INSERT INTO `producto_reporte_vencimiento`(`idproducto`, `idreporte_vencimiento`, `fecha_vencimiento`, `cantidad`) 
VALUES 
(
    '$idproducto',
    '$idreporte_vencimiento',
    '$fecha_vencimiento',
    '$cantidad ')
";


mysqli_query($conexion, $sql);

$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "Registro guardado con éxito.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] = mysqli_error($conexion);
}
echo json_encode($respuesta);