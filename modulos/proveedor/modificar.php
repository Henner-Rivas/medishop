<?php
require_once("conexion.php");
$idproveedor = $_POST['idproveedor'];
$idpersona = $_POST['idpersona'];


$errores = "";
$respuesta = [];

if ($idpersona == "") {
    $errores .= "<li>El campo 'Proveedor' es obligatorio</li>";
}




if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "UPDATE proveedor

set
idpersona='$idpersona'

where idproveedor=$idproveedor";


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
