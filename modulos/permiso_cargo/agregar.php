<?php
require_once("conexion.php");
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



$sql1 = "INSERT INTO `permiso_cargo`( `id_cargo`, `modulo`, `accion`) VALUES
 ('$idcargo',
 '$modulo',
 '$accion'

                        )";
mysqli_query($conexion, $sql1);



$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "Permiso creado con éxito.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] =mysqli_error($conexion);
}
echo json_encode($respuesta);