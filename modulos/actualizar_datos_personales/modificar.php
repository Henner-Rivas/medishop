<?php
require_once("conexion.php");
$usuario = $_POST['usuario'];
$idpersona = $_POST['idpersona'];

$idtipoidentificacion = $_POST['idtipoidentificacion'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$idmunicipio_expedicion = $_POST['municipio_id'];
$telefono = $_POST['telefono'];

function buscarUsuario($usuario,$conexion){
 $sqlexiste1="SELECT * FROM `usuario` where usuario='$usuario' AND usuario != '".$_SESSION['usuario']."'" ;
$result =mysqli_query($conexion, $sqlexiste1); 

if (mysqli_num_rows($result)>0) {
    return 1;

}else{
 return 0;
    }
}
$errores = "";
$respuesta = [];

if ($idtipoidentificacion == "") {
    $errores .= "<li>El campo 'Tipo identificación' es obligatorio</li>";
}


if ($nombre == "") {
    $errores .= "<li>El campo 'Nombre' es obligatorio</li>";
}

if ($apellidos == "") {
    $errores .= "<li>El campo 'Apellido' es obligatorio</li>";
}

if ($idmunicipio_expedicion == "") {
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
}if (buscarUsuario($usuario,$conexion)==1) {
    $errores .= "<li>Usuario ya existe </li>";
}else{

    $sqlu="UPDATE usuario SET usuario='$usuario' WHERE id_usuario ='".$_SESSION['id_usuario']."'"; 
    mysqli_query($conexion, $sqlu);

}


if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}


$sql = "UPDATE  persona SET
            idtipoidentificacion='$idtipoidentificacion', 
            nombre='$nombre', 
            apellidos='$apellidos', 
            idmunicipio_expedicion='$idmunicipio_expedicion', 
            direccion='$direccion',
            email='$email',
            telefono='$telefono'
        WHERE idpersona ='".$_SESSION['idpersona']."'";
                         ;

mysqli_query($conexion, $sql);
$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "Registro modificado con éxito.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] = mysqli_error($conexion);
}
echo json_encode($respuesta);
        ///    identificacion='$identificacion', 
