<?php
require_once("conexion.php");
$id_permiso_cargo = $_POST['id_permiso_cargo'];
$idcargo = $_POST['idcargo'];
$modulo = $_POST['modulo'];
$accion = $_POST['accion'];


$errores = "";
$respuesta = [];

if ($idcargo == "") {
    $errores .= "<li>El campo 'cargo' es obligatorio</li>";
}

if ($modulo == "") {
    $errores .= "<li>El campo 'modulo' es obligatorio</li>";
}

if ($accion == "") {
    $errores .= "<li>El campo 'accion' es obligatorio</li>";
}




if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "UPDATE permiso_cargo

set
id_cargo='$idcargo',
modulo='$modulo',
accion='$accion'

where id_permiso_cargo=$id_permiso_cargo";


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
