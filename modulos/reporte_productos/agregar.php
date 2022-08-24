<?php
require_once("conexion.php");
$idproducto = $_POST['idproducto'];
$cantidad_actual = $_POST['cantidad_actual'];
$idempleado = $_POST['idempleado'];



$errores = "";
$respuesta = [];

if ($idproducto == "") {
    $errores .= "<li>El campo ' Producto' es obligatorio</li>";
}
if ($idempleado == "") {
    $errores .= "<li>El campo ' Empleado' es obligatorio</li>";
}
if ($cantidad_actual == "") {
    $errores .= "<li>El campo 'Cantidad actual' es obligatorio</li>";
}



if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "INSERT INTO `reporte_prodcuto`( `cantidad_actual`, `idproducto`, `idempleado`) VALUES (
'$cantidad_actual',
'$idproducto',
'$idempleado')
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
