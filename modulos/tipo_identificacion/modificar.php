<?php
require_once("conexion.php");
$idtipo_identificacion = $_POST['idtipo_identificacion'];
$nombre = $_POST['nombre'];



$errores = "";
$respuesta = [];

if ($nombre == "") {
    $errores .= "<li>El campo ' Tipo de identificación' es obligatorio</li>";
}



if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "UPDATE tipo_identificacion

set
nombre='$nombre'

where idtipo_identificacion=$idtipo_identificacion


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
