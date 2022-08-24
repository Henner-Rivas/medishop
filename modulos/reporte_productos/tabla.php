<?php

require_once("conexion.php");


$filtros = "";
if (isset($_GET['cproducto']) &&  $_GET['cproducto'] != "") {
    $cproducto = $_GET['cproducto'];
    $cproducto = str_replace(" ", "%", $cproducto);
    $filtros .= "  AND  producto.codigo LIKE '%$cproducto%'";
}

if (isset($_GET['cantidad_actual']) &&  $_GET['cantidad_actual'] != "") {
    $cantidad_actual = $_GET['cantidad_actual'];
//Buscar espacio y reemplazarlos por %
    $cantidad_actual = str_replace(" ", "%", $cantidad_actual);
    $filtros .= "  AND  cantidad_actual LIKE '%$cantidad_actual%'";
}

if (isset($_GET['nproducto']) &&  $_GET['nproducto'] != "") {
    $nproducto = $_GET['nproducto'];
//Buscar espacio y reemplazarlos por %
    $nproducto = str_replace(" ", "%", $nproducto);
    $filtros .= "  AND  producto.nombre LIKE '%$nproducto%'";
}
if (isset($_GET['unidad_medida']) &&  $_GET['unidad_medida'] != "") {
    $unidad_medida = $_GET['unidad_medida'];
//Buscar espacio y reemplazarlos por %
    $unidad_medida = str_replace(" ", "%", $unidad_medida);
    $filtros .= "  AND  unidad_medida.nombre LIKE '%$unidad_medida%'";
}

if (isset($_GET['via_administracion']) &&  $_GET['via_administracion'] != "") {
    $via_administracion = $_GET['via_administracion'];
//Buscar espacio y reemplazarlos por %
    $via_administracion = str_replace(" ", "%", $via_administracion);
    $filtros .= "  AND  via_administracion.nombre LIKE '%$via_administracion%'";
}


if (isset($_GET['nempleado']) &&  $_GET['nempleado'] != "") {
    $nempleado = $_GET['nempleado'];
//Buscar espacio y reemplazarlos por %
    $nempleado = str_replace(" ", "%", $nempleado);
    $filtros .= "  AND concat_ws(' ', persona.nombre,persona.apellidos) LIKE '%$nempleado%'";
}
if (isset($_GET['identifica']) &&  $_GET['identifica'] != "") {
    $identifica = $_GET['identifica'];
//Buscar espacio y reemplazarlos por %
    $identifica = str_replace(" ", "%", $identifica);
    $filtros .= "  AND  persona.identificacion LIKE '%$identifica%'";
}

if (isset($_GET['cargo']) &&  $_GET['cargo'] != "") {
    $cargo = $_GET['cargo'];
//Buscar espacio y reemplazarlos por %
    $cargo = str_replace(" ", "%", $cargo);
    $filtros .= "  AND  cargo.nombre LIKE '%$cargo%'";
}


$sql_base = "SELECT idreporte_producto,
            producto.codigo as codigo_producto,
            cantidad_actual as cantidad_actual,
            producto.nombre as nombre_producto,
            producto.valor_unitario,
            producto.descripcion as descripcion_producto,
            unidad_medida.nombre as unidad_medida,
            via_administracion.nombre as via_administracion,
            presentacion.nombre as presentacion, 
            producto.iva,
            concat_ws(' ', persona.nombre,persona.apellidos) as nombre_completo_empleado,
            persona.identificacion as identificacion,
            cargo.nombre as cargo,
            tipo_identificacion.nombre as tipo_identificacion,
            municipio.nombre as idmunicipio, 

            persona.direccion as direccion,
            persona.email as email,
            persona.telefono as telefono

            FROM reporte_prodcuto

            join empleado on reporte_prodcuto.idempleado=empleado.idempleado
            join persona on empleado.idpersona=persona.idpersona
            join cargo on empleado.idcargo=cargo.idcargo
            join tipo_identificacion on persona.idtipoidentificacion=tipo_identificacion.idtipo_identificacion
            join producto on reporte_prodcuto.idproducto=producto.idproducto
            join unidad_medida on producto.idunidad_medida=unidad_medida.idunidad_medida
            join via_administracion on producto.idvia_administracion = via_administracion.idvia_administracion
            join presentacion on producto.idpresentacion = presentacion.idpresentacion
            join municipio on persona.idmunicipio_expedicion = municipio.idmunicipio
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
                <th scope="col">Código del producto</th>
                                <th scope="col">Cantidad actual</th>

                <th scope="col">Nombre del producto</th>
                <th scope="col">Unidad de medida</th>
                <th scope="col">Via de administración</th>
                <th scope="col">Nombre del empleado</th>
                <th scope="col">Identificación</th>
                <th scope="col">Cargo</th>

                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>



            <tr id="tr-filtros" style="display: none;">
 
            <th scope="col"> </th>

                <th scope="col">
                    <input type="text" name="cproducto" class="form-control form-control-sm" value="<?php echo isset($_GET['cproducto']) ? $_GET['cproducto'] : ""  ?>" /></th>
 <th scope="col">
                    <input type="text" name="cantidad_actual" class="form-control form-control-sm" value="<?php echo isset($_GET['cantidad_actual']) ? $_GET['cantidad_actual'] : ""  ?>" /></th>


                <th scope="col"><input type="text" name="nproducto" class="form-control form-control-sm" value="<?php echo isset($_GET['nproducto']) ? $_GET['nproducto'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="unidad_medida" class="form-control form-control-sm" value="<?php echo isset($_GET['unidad_medida']) ? $_GET['unidad_medida'] : ""  ?>" /></th>
                
                 <th scope="col"><input type="text" name="via_administracion" class="form-control form-control-sm" value="<?php echo isset($_GET['via_administracion']) ? $_GET['via_administracion'] : ""  ?>" /></th>


                
                 

                <th scope="col"><input type="text" name="nempleado" class="form-control form-control-sm" value="<?php echo isset($_GET['nempleado']) ? $_GET['nempleado'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="identifica" class="form-control form-control-sm" value="<?php echo isset($_GET['identifica']) ? $_GET['identifica'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="cargo" class="form-control form-control-sm" value="<?php echo isset($_GET['cargo']) ? $_GET['cargo'] : ""  ?>" /></th>      
                  

            

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
                    <td><?php echo $mostrar['codigo_producto'] ?></td>
                    <td><?php echo $mostrar['cantidad_actual'] ?></td>
                    <td><?php echo $mostrar['nombre_producto'] ?></td>
                    <td><?php echo $mostrar['unidad_medida'] ?></td>
                    <td><?php echo $mostrar['via_administracion'] ?></td>
                    <td><?php echo $mostrar['nombre_completo_empleado'] ?></td>
                    <td><?php echo $mostrar['identificacion'] ?></td>
                    <td><?php echo $mostrar['cargo'] ?></td>




                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['idreporte_producto'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['idreporte_producto'] ?>')">
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