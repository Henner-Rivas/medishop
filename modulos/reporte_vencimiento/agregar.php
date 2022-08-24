<?php
require_once("conexion.php");

$idempleado= $_POST['idempleado'];




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

$sql = "INSERT INTO `reporte_vencimiento`( `idempleado`) VALUES 

('$idempleado'



)
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