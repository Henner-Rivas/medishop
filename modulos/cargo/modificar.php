<?php
require_once("conexion.php");
$idcargo = $_POST['idcargo'];
$cargo = $_POST['cargo'];


$errores = "";
$respuesta = [];

if ($cargo == "") {
    $errores .= "<li>El campo ' cargo' es obligatorio</li>";
}




if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "
UPDATE `cargo` SET `nombre`='$cargo'
WHERE `idcargo`='$idcargo'

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
