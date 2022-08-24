<?php
require_once("conexion.php");
$idproducto_salida = $_POST['idproducto_salida'];
$idproducto = $_POST['idproducto'];
$idsalida = $_POST['idsalida'];
$cantidad = $_POST['cantidad'];


$errores = "";
$respuesta = [];

if ($idproducto == "") {
    $errores .= "<li>El campo ' Producto' es obligatorio</li>";
}
if ($idsalida == "") {
    $errores .= "<li>El campo 'Salida de producto' es obligatorio</li>";
}
if ($cantidad == "") {
    $errores .= "<li>El campo 'Cantidad' es obligatorio</li>";
}



if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "UPDATE producto_salida

set
idproducto='$idproducto',

idsalida='$idsalida',

cantidad='$cantidad'
where idproducto_salida=$idproducto_salida


";


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
