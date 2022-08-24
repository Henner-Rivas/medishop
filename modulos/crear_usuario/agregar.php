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
$idcargo = $_POST['idcargo'];

$usuario = $_POST['usuario'];

$clave = $_POST['clave'];
$clave2 = $_POST['clave2'];

function buscarRepetido($usuario,$conexion){
 $sqlexiste1="SELECT * FROM `usuario` where usuario='$usuario' ";
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
if ($usuario == "") {
    $errores .= "<li>El campo 'email' es obligatorio</li>";
}


if ($clave == "") {
    $errores .= "<li>El campo 'clave' es obligatorio</li>";
}
if ($clave2 == "") {
    $errores .= "<li>El campo 'Repita clave ' es obligatorio</li>";
}
if ($clave != $clave2) {
    $errores .= "<li>Las contraseñas no coinciden</li>";
}
if (buscarRepetido($usuario,$conexion)==1) {
    $errores .= "<li>Usuario ya existe </li>";
}
if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}

 $sqlexiste1="SELECT * FROM `usuario` 

JOIN persona on usuario.id_persona= persona.idpersona
 where usuario='$usuario' OR email='$email'"


 ;
$rs = mysqli_query($conexion, $sqlexiste1);
$respuesta = [];

if ($rw = mysqli_fetch_assoc($rs)) {


if ($rw['usuario'] == $usuario && $rw['email'] == $email) {
                $respuesta['error'] = true;
        $respuesta['msg'] = " <li>usuario $usuario ya  existe</li> <li>El correo $email ya existe</li>";

    }elseif ($rw['usuario'] == $usuario) {
                $respuesta['error'] = true;
        $respuesta['msg'] = "usuario $usuario ya  existe";

    }else if ($rw['email'] == $email) {
         $respuesta['error'] = true;
        $respuesta['msg'] = "El correo $email ya existe";
    }
echo json_encode($respuesta);

}else {



$sql1 = "INSERT INTO persona (
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
mysqli_query($conexion, $sql1);

$idpersona=mysqli_insert_id($conexion);

$sql2="INSERT INTO `usuario`( `id_persona`, `usuario`, `clave`, `id_cargo`)

VALUES (
'$idpersona',
'$usuario',
'$clave',
'$idcargo')";

mysqli_query($conexion, $sql2);



$sql3="INSERT INTO `empleado`( `idpersona`, `idcargo`) VALUES
 (
'$idpersona',
 '$idcargo')";

mysqli_query($conexion, $sql3);



$respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = "usuario creado con éxito.";
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] =mysqli_error($conexion);
}

echo json_encode($respuesta);
}