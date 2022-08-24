<?php

// Para el proyecto final, averiguar que es inyección SQL
// Poner el codigo necesario para que no se pueda ingresar al software  
// aplicando esta tecnica 
// aplicando esta tecnica 

require_once("conexion.php");
/*
*/$usuario =mysqli_real_escape_string($conexion,$_POST['usuario'] );
$clave = mysqli_real_escape_string($conexion,$_POST['clave'] );

$errores = "";
$respuesta = [];

if ($usuario == "") {
    $errores .= "<li>El campo ' Usuario' es obligatorio</li>";
}
if ($clave == "") {
    $errores .= "<li>El campo ' Clave' es obligatorio</li>";
}


if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
        exit(0);

 }

  
$sql = "SELECT u.id_usuario,p.identificacion,
 p.nombre, p.apellidos, u.clave, u.id_cargo,p.idpersona, u.usuario,

 c.nombre as usuario_cargo FROM usuario u 

JOIN persona p ON u.id_persona = p.idpersona 
join cargo c on u.id_cargo = c.idcargo


        WHERE
            u.usuario = '$usuario'";
$rs = mysqli_query($conexion, $sql);
$respuesta = [];

if ($rw = mysqli_fetch_assoc($rs)) {
    //Encontró el usuario
    //Validar que la clave sera correcta
    if ($rw['clave'] == $clave) {
        //Usuario y clave correcta. Dar permiso de acceso.
        $respuesta['error'] = false;
        $respuesta['msg'] = "Ok";

        $_SESSION['usuario'] = $usuario;
        $_SESSION['usuario_identifica'] = $rw['identificacion'];

        $_SESSION['usuario_cargo'] = $rw['usuario_cargo'];
        $_SESSION['idpersona'] = $rw['idpersona'];

               // $_SESSION['usuario_cargo'] = $rw['usuario_cargo'];
                $_SESSION['id_cargo'] = $rw['id_cargo'];
                $_SESSION['id_usuario'] = $rw['id_usuario'];
                $_SESSION['clave'] = $rw['clave'];

        $_SESSION['usuario_nombre'] = $rw['nombre'] .  " " . $rw['apellidos'];


    } else {
        // clave es incorrecta
        $respuesta['error'] = true;
        $respuesta['msg'] = "Contraseña incorrecta";
    }
} else {
    //No encontró ningún usuario
    $respuesta['error'] = true;
    $respuesta['msg'] = "El usuario ingresado no existe";
}

echo json_encode($respuesta);

