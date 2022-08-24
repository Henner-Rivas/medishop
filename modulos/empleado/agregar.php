<?php
require_once("conexion.php");

$idempleado = $_POST['idempleado'];
$idpersona= $_POST['idpersona'];

$idcargo= $_POST['idcargo'];



$errores = "";
$respuesta = [];


if ($idpersona == "") {
    $errores .= "<li>El campo 'Persona' es obligatorio</li>";
}

if ($idcargo == "") {
    $errores .= "<li>El campo 'Cargo' es obligatorio</li>";
}



if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}

$sql = "INSERT INTO `empleado`( `idpersona`, `idcargo`) VALUES (
'$idpersona',
'$idcargo')
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