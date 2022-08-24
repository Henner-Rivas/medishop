<?php
if ($permiso_acceso == true) {
    require_once($ruta_archivo);
} else {
?>
    <div class="alert alert-danger mt-2" role="alert" style="left: 110px;">
        Acceso denegado !!!
    </div>
<?php
}
