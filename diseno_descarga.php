<?php
if ($permiso_acceso == true) {
    require_once($ruta_archivo);
} else {
?>
    <h1>
        Acceso denegado !!!
    </h1>
<?php
}
