<?php
require_once("configuracion.php");
require_once("conexion.php");

if (isset($_GET['modulo'])) {
    $modulo = $_GET['modulo'];
} else {
    $modulo = "contenido1";
}
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
} else {
    $accion = "ver";
}
$ruta = $modulos[$modulo]["ruta"];
$archivo = $modulos[$modulo]['acciones'][$accion]['archivo'];
$diseno = $modulos[$modulo]['acciones'][$accion]['diseño'];

$ruta_archivo = $ruta . $archivo;


if (isset($modulos[$modulo]["no_pedir_permiso"])) {
    $no_pedir_permiso = $modulos[$modulo]["no_pedir_permiso"];
} else {
    $no_pedir_permiso = false;
}

if($no_pedir_permiso==true) {
    $permiso_acceso = true;
} else {
    if (isset($_SESSION['id_cargo'])) {
        $rol = $_SESSION['id_cargo'];
    } else {
        $rol = "";
    }

    $sql_permiso = "SELECT COUNT(*) as cantidad FROM 
permiso_cargo 
WHERE 
modulo='$modulo' 
AND id_cargo='$rol'
 AND accion='$accion'";
    $rs_permiso = mysqli_query($conexion, $sql_permiso);
    $rw_permiso = mysqli_fetch_array($rs_permiso);

    if ($rw_permiso['cantidad'] == 0) {
        $permiso_acceso = false;
    } else {
        $permiso_acceso = true;
    }
}


if ($diseno == "pagina") {
    require_once("diseno_pagina.php");
} else  if ($diseno == "pagina-nueva") {
    require_once("diseno_pagina.php");
} else if ($diseno == "html") {
    require_once("diseno_html.php");
}else if ($diseno == "pagina-contenido") {
    require_once("diseno_pagina_contenido.php");
}else if ($diseno == "json") {
    require_once("diseno_json.php");
} else if ($diseno == "descarga") {
    require_once("diseno_descarga.php");
}else if ($diseno == "modal") {
    require_once("diseno_modal.php");
}
