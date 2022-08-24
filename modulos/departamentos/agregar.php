<?php
require_once("conexion.php");

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
$sql = "INSERT INTO `departamento`(`nombre`) VALUES ('$departamento')
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
