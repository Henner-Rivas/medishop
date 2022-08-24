<?php
require_once("conexion.php");

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
$sql = "INSERT INTO `presentacion`(`nombre`) VALUES ('$presentacion')
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
