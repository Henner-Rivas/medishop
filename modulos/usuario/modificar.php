<?php
require_once("conexion.php");
$idusuario = $_POST['idusuario'];
$usuario = $_POST['usuario'];
$idcargo = $_POST['idcargo'];
$contrasena = $_POST['clave'];
$idpersona = $_POST['idpersona'];



$errores = "";
$respuesta = [];

if ($usuario == "") {
    $errores .= "<li>El campo ' usuario' es obligatorio</li>";
}
if ($idcargo == "") {
    $errores .= "<li>El campo ' cargo' es obligatorio</li>";
}
if ($contrasena == "") {
    $errores .= "<li>El campo 'contraseña' es obligatorio</li>";
}
if ($idpersona == "") {
    $errores .= "<li>El campo 'persona' es obligatorio</li>";
}



if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}
$sql = "

UPDATE `usuario` SET `id_persona`='$idpersona',`usuario`='$usuario',`contraseña`='$contrasena',`id_cargo`='$idcargo'
WHERE id_usuario='$idusuario'

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
