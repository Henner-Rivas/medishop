<?php
require_once("conexion.php");

$idtipoidentificacion = $_POST['tipo_identificacion_id'];
$identificacion = $_POST['identificacion'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$idmunicipo_expedicion = $_POST['municipio_id'];
$telefono = $_POST['telefono'];

$errores = "";
$respuesta = [];

if ($idtipoidentificacion == "") {
    $errores .= "<li>El campo 'Tipo identificación' es obligatorio</li>";
}

if ($identificacion == "") {
    $errores .= "<li>El campo 'Identificación' es obligatorio</li>";
}

if ($nombre == "") {
    $errores .= "<li>El campo 'Nombre' es obligatorio</li>";
}

if ($apellidos == "") {
    $errores .= "<li>El campo 'Apellido' es obligatorio</li>";
}

if ($idmunicipo_expedicion == "") {
    $errores .= "<li>El campo 'Municipio' es obligatorio</li>";
}
if ($direccion == "") {
    $errores .= "<li>El campo 'direccion' es obligatorio</li>";
}
if ($email == "") {
    $errores .= "<li>El campo 'email' es obligatorio</li>";
}


if ($telefono == "") {
    $errores .= "<li>El campo 'Telefono' es obligatorio</li>";
}


if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}



$sql = "INSERT INTO persona (
                        idtipoidentificacion, 
                        identificacion, 
                        nombre, 
                        apellidos, 
                        idmunicipio_expedicion, 
                        direccion,
                        email,
                        telefono) VALUES (
                            '$idtipoidentificacion', 
                            '$identificacion', 
                            '$nombre', 
                            '$apellidos', 
                            '$idmunicipo_expedicion', 
                            '$direccion',
                            '$email',
                            '$telefono'
                        )";
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