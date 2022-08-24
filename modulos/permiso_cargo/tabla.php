<?php
/*
define('SITE_ROOT', __DIR__);
require_once SITE_ROOT."../../conexion.php";*/
require_once("conexion.php");


$filtros = "";
if (isset($_GET['cargo']) &&  $_GET['cargo'] != "") {
    $cargo = $_GET['cargo'];
    $cargo = str_replace(" ", "%", $cargo);
    $filtros .= "  AND  cargo.nombre LIKE '%$cargo%'";
}


if (isset($_GET['c_accion']) &&  $_GET['c_accion'] != "") {
    $c_accion = $_GET['c_accion'];
    $c_accion = str_replace(" ", "%", $c_accion);
    $filtros .= "  AND  permiso_cargo.accion LIKE '%$c_accion%'";
}
if (isset($_GET['cmodulo']) &&  $_GET['cmodulo'] != "") {
    $cmodulo = $_GET['cmodulo'];
    $cmodulo = str_replace(" ", "%", $cmodulo);
    $filtros .= "  AND  permiso_cargo.modulo LIKE '%$cmodulo%'";
}
$sql_base = "SELECT id_permiso_cargo,
           cargo.nombre as cargo,
           permiso_cargo.modulo, 
           permiso_cargo.accion

            FROM permiso_cargo

    
            join cargo on permiso_cargo.id_cargo=cargo.idcargo
            where true $filtros

            ";


$num_reg_paginas = 4;
$pagina_actual = $_GET['pagina_actual'];

$sql_cantidad = "SELECT COUNT(*) FROM ($sql_base) as t";
$rs_cantidad = mysqli_query($conexion, $sql_cantidad);
$rw_cantidad = mysqli_fetch_row($rs_cantidad);
$cantidad_registros = $rw_cantidad[0];

$primer_registro = ($pagina_actual - 1) * $num_reg_paginas;


$cantidad_paginas = ceil($cantidad_registros / $num_reg_paginas);


$sql_final = $sql_base . " LIMIT $primer_registro , $num_reg_paginas  ";
?>

<form id="form-filtro">
    <table class="table table-striped">
        <thead>
            <tr>


                <th scope="col">Num.</th>
                <th scope="col">Cargo</th>
                <th scope="col">Modulo</th>
                
                  <th scope="col">Acción</th>
               

                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>



 <tr id="tr-filtros"  <?php echo $filtros !='' ?  '' : 'style=

  "display: none;" ' ?> >  
            <th scope="col"> </th>

               

                <th scope="col">
                    <input type="text" name="cargo" class="form-control form-control-sm" value="<?php echo isset($_GET['cargo']) ? $_GET['cargo'] : ""  ?>" /></th>

                           <th scope="col">
                    <input type="text" name="cmodulo" class="form-control form-control-sm" value="<?php echo isset($_GET['cmodulo']) ? $_GET['cmodulo'] : ""  ?>" /></th>
     
                <th scope="col">
                    <input type="text" name="c_accion" class="form-control form-control-sm" value="<?php echo isset($_GET['c_accion']) ? $_GET['c_accion'] : ""  ?>" /></th>
                    
                <th scope="col" style="text-align: center;">
                    <button class="btn btn-sm btn-primary" onclick="cargar_tabla()">
                        <i class="fas fa-search"></i>
                    </button>
                </th>

            </tr>


        </thead>
        <tbody>
            <?php


            

            $result = mysqli_query($conexion, $sql_final);
            $num = $primer_registro  + 1;
            while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $num++ ?></td>
                    <td><?php echo $mostrar['cargo'] ?></td>
                    <td><?php echo $mostrar['modulo'] ?></td>
                       <td><?php echo $mostrar['accion'] ?></td>
                  




                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['id_permiso_cargo'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['id_permiso_cargo'] ?>')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>

        <tfoot style="text-align: center;">
             <tr>
                <td colspan="10">
                    <button type="button" class="btn btn-sm btn-light" onclick="mover_pagina('1')">
                        <i class="fas fa-angle-double-left"></i>
                    </button>
                    <button type="button" class="btn btn-light" onclick="mover_pagina('<?php echo $pagina_actual - 1 ?>')">
                        <i class="fas fa-angle-left"></i>
                    </button>

                    <span>
                        <input style="width: 50px; text-align:center" type="text" id="pagina_actual" value="<?php echo $pagina_actual ?>" onchange="mover_pagina(this.value)" />
                        /
                        <input style="width: 50px; text-align:center" type="text" id="cantidad_paginas" readonly value="<?php echo $cantidad_paginas ?>" />

                    </span>

                    <button type="button" class="btn btn-sm btn-light" onclick="mover_pagina('<?php echo $pagina_actual + 1 ?>')">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-light" onclick="mover_pagina('<?php echo $cantidad_paginas ?>')">

<i class="fas fa-angle-double-right"></i>

</button>

                    <span>
                        <?php  
                        echo " | Mostrando del ";
                        echo ($primer_registro + 1)  . " al " . ($primer_registro + $num_reg_paginas);
                        echo " de " . $cantidad_registros . " registro(s)";  
                        ?>
                    </span>
                </td>
            </tr>
            



        </tfoot>
    </table>
</form>