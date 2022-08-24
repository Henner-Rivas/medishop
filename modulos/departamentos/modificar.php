<?php
require_once("conexion.php");
$iddepartamento = $_POST['iddepartamento'];
$departamento = $_POST['departamento'];


$errores = "";
$respuesta = [];

if ($departamento == "") {
    $errores .= "<li>El campo ' departamento' es obligatorio</li>";
}




if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "
UPDATE `departamento` SET `nombre`='$departamento'
WHERE `iddepartamento`='$iddepartamento'

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
