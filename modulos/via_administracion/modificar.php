<?php
require_once("conexion.php");
$idvia_administracion = $_POST['idvia_administracion'];
$nombre = $_POST['nombre'];


$errores = "";
$respuesta = [];

if ($nombre == "") {
    $errores .= "<li>El campo 'Via de administracion' es obligatorio</li>";
}




if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "UPDATE via_administracion

set
nombre='$nombre'

where idvia_administracion=$idvia_administracion";


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
