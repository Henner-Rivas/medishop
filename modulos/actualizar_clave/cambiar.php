<?php

$clave0 = $_POST['clave0'];
$clave1 = $_POST['clave1'];
$clave2 = $_POST['clave2'];



$errores = "";
$respuesta = [];

if ($clave0 == "") {
    $errores .= "<li>El campo 'Clave actual' es obligatorio</li>";
}
if ($clave1 == "") {
    $errores .= "<li>El campo ' Nueva clave' es obligatorio</li>";
}if ($clave2 == "") {
    $errores .= "<li>El campo ' Nueva clave' es obligatorio</li>";
}if ($clave0 != $_SESSION['clave']) {
    $errores .= "<li>La clave actual no es correca";
}if ($clave2 != $clave1) {
    $errores .= "<li>La Nueva contraseña no es identica</li>";
}



if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
        exit(0);

 }
if ($clave0 == $_SESSION['clave']) {

$sql= "UPDATE usuario SET clave='$clave1' WHERE id_usuario='".$_SESSION['id_usuario']."'";

 mysqli_query($conexion, $sql);
}

$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "Se ha actualizado su contraseña.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] = mysqli_error($conexion);
}
echo json_encode($respuesta);
