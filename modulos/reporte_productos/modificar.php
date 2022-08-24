<?php
require_once("conexion.php");
$idreporte_producto = $_POST['idreporte_producto'];
$cantidad_actual = $_POST['cantidad_actual'];
$idempleado = $_POST['idempleado'];
$idproducto = $_POST['idproducto'];


$errores = "";
$respuesta = [];

if ($idproducto == "") {
    $errores .= "<li>El campo ' Producto' es obligatorio</li>";
}
if ($idempleado == "") {
    $errores .= "<li>El campo ' Empleado' es obligatorio</li>";
}
if ($cantidad_actual == "") {
    $errores .= "<li>El campo 'Cantidad actual' es obligatorio</li>";
}



if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "UPDATE reporte_prodcuto





set
idproducto='$idproducto',

idempleado='$idempleado',

cantidad_actual='$cantidad_actual'
where idreporte_producto=$idreporte_producto


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
