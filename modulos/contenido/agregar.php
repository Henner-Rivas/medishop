<?php
require_once("conexion.php");


$modulo = $_POST['modulo'];
$titulo = $_POST['titulo'];
$contenido = $_POST['contenido'];

 
$errores = "";
$respuesta = [];


if ($modulo == "") {
    $errores .= "<li>El campo ' Modulo' es obligatorio</li>";
}
if ($titulo == "") {
    $errores .= "<li>El campo ' Titulo' es obligatorio</li>";
}
if ($contenido == "") {
    $errores .= "<li>El campo 'Contenido' es obligatorio</li>";
}



if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}


$sql = "INSERT INTO contenido (
                        modulo, 
                        titulo, 
                        contenido) VALUES (
                            '$modulo', 
                            '$titulo', 
                            '$contenido' 
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
