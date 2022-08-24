<?php
require_once("conexion.php");

$id_permiso_cargo = $_POST['id_permiso_cargo'];

$sql = "DELETE FROM permiso_cargo WHERE id_permiso_cargo ='$id_permiso_cargo'";

mysqli_query($conexion, $sql);
$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "Registro eliminado con éxito.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] = mysqli_error($conexion);
}
echo json_encode($respuesta);
