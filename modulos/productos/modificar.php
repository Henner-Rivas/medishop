<?php
require_once("conexion.php");

$idproducto = $_POST['idproducto'];
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$unidad_medida = $_POST['unidad_medida'];
$via_administracion = $_POST['via_administracion'];
$presentacion = $_POST['presentacion'];
$iva = $_POST['iva'];
$valor_unitario = $_POST['valor_unitario'];

$errores = "";
$respuesta = [];

if ($codigo == "") {
    $errores .= "<li>El campo 'codigo' es obligatorio</li>";
}

if ($nombre == "") {
    $errores .= "<li>El campo 'nombre' es obligatorio</li>";
}

if ($descripcion == "") {
    $errores .= "<li>El campo 'Descripción' es obligatorio</li>";
}

if ($unidad_medida == "") {
    $errores .= "<li>El campo 'unidad medida' es obligatorio</li>";
}

if ($via_administracion == "") {
    $errores .= "<li>El campo 'via administracion' es obligatorio</li>";
}
if ($presentacion == "") {
    $errores .= "<li>El campo 'presentacion' es obligatorio</li>";
}
if ($iva == "") {
    $errores .= "<li>El campo 'iva' es obligatorio</li>";
}


if ($valor_unitario == "") {
    $errores .= "<li>El campo 'precio unitario' es obligatorio</li>";
}


if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}



$sql = "UPDATE  `producto` SET
         codigo= '$codigo', 
         nombre='$nombre', 
         descripcion='$descripcion', 
         idunidad_medida= '$unidad_medida',
         idvia_administracion= '$via_administracion',
          idpresentacion='$presentacion', 
          iva= '$iva',
          valor_unitario='$valor_unitario'
          WHERE idproducto='$idproducto'"
        ;
mysqli_query($conexion, $sql);
$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "Registro editados con éxito.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] = mysqli_error($conexion);
}
echo json_encode($respuesta);