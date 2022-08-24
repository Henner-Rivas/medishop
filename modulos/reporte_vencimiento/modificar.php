<?php
require_once("conexion.php");

$idempleado= $_POST['idempleado'];
$idreporte_vencimiento= $_POST['idreporte_vencimiento'];




$errores = "";
$respuesta = [];


if ($idempleado == "") {
    $errores .= "<li>El campo 'Empleado' es obligatorio</li>";
}




if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}

$sql = "UPDATE `reporte_vencimiento` SET `idempleado`='$idempleado' WHERE idreporte_vencimiento='$idreporte_vencimiento'
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