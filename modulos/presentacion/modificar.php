<?php
require_once("conexion.php");
$idpresentacion = $_POST['idpresentacion'];
$presentacion = $_POST['presentacion'];


$errores = "";
$respuesta = [];

if ($presentacion == "") {
    $errores .= "<li>El campo ' presentacion' es obligatorio</li>";
}




if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "
UPDATE `presentacion` SET `nombre`='$presentacion'
WHERE `idpresentacion`='$idpresentacion'

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
