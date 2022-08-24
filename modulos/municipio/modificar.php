<?php
require_once("conexion.php");
$idmunicipio = $_POST['idmunicipio'];
$departamento = $_POST['departamento'];
$municipio= $_POST['municipio'];
$departamento2=$_POST['departamento2'];

$errores = "";
$respuesta = [];

if ($departamento == "" && $departamento2=="") {
    $errores .= "<li>El campo ' departamento' es obligatorio</li>";
}
if ($municipio == "") {
    $errores .= "<li>El campo ' municipio' es obligatorio</li>";
}



if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
    exit(0);
}

if ( $departamento2 =="") {
   
$sql = "
UPDATE `municipio` SET `nombre`='$municipio',`iddepartamento`='$departamento'
 WHERE idmunicipio='$idmunicipio'
";
 mysqli_query($conexion, $sql);

}elseif ($departamento2 != "") {


///////////////////////////////////////////////////////////////////////////

  
   $sql2 = "INSERT INTO `departamento`( `nombre`) VALUES ('$departamento2')
";
 mysqli_query($conexion, $sql2); 

$iddepartamento2=mysqli_insert_id($conexion);


/////////////////////////

$sql = "
UPDATE `municipio` SET `nombre`='$municipio',`iddepartamento`='$iddepartamento2'
 WHERE idmunicipio='$idmunicipio'
";
 mysqli_query($conexion, $sql);

}


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
