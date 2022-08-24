




<?php
if($permiso_acceso==true) {
    require_once($ruta_archivo);
} else {
	
    $respuesta = [];
    $respuesta['msg'] = "Acceso denegado !!!";
    $respuesta['error'] = true;
    echo json_encode($respuesta);
}
?>

