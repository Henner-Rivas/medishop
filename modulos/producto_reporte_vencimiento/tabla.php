<?php

require_once("conexion.php");

$filtros = "";
if (isset($_GET['codigo']) &&  $_GET['codigo'] != "") {
    $codigo = $_GET['codigo'];
//Buscar espacio y reemplazarlos por %
    $codigo = str_replace(" ", "%", $codigo);
    $filtros .= "  AND  producto.codigo LIKE '%$codigo%'";
}
if (isset($_GET['nombre_producto']) &&  $_GET['nombre_producto'] != "") {
    $nombre_producto = $_GET['nombre_producto'];
    $nombre_producto = str_replace(" ", "%", $nombre_producto);
    $filtros .= "  AND  producto.nombre LIKE '%$nombre_producto%'";
}

if (isset($_GET['nombre_completo']) &&  $_GET['nombre_completo'] != "") {
    $nombre_completo = $_GET['nombre_completo'];
//Buscar espacio y reemplazarlos por %
    $nombre_completo = str_replace(" ", "%", $nombre_completo);
    $filtros .= "  AND  concat_ws(' ', persona.nombre,persona.apellidos) LIKE '%$nombre_completo%'";
}
if (isset($_GET['identificacion']) &&  $_GET['identificacion'] != "") {
    $identificacion = $_GET['identificacion'];
//Buscar espacio y reemplazarlos por %
    $identificacion = str_replace(" ", "%", $identificacion);
    $filtros .= "  AND persona.identificacion LIKE '%$identificacion%'";
}

if (isset($_GET['fecha_vencimiento']) &&  $_GET['fecha_vencimiento'] != "") {
    $fecha_vencimiento = $_GET['fecha_vencimiento'];
    $fecha_vencimiento = str_replace(" ", "%", $fecha_vencimiento);
    $filtros .= "  AND  producto_reporte_vencimiento.fecha_vencimiento LIKE '%$fecha_vencimiento%'";
}




if (isset($_GET['cantidad']) &&  $_GET['cantidad'] != "") {
    $cantidad = $_GET['cantidad'];
//Buscar espacio y reemplazarlos por %
    $cantidad = str_replace(" ", "%", $cantidad);
    $filtros .= "  AND producto_reporte_vencimiento.cantidad LIKE '%$cantidad%'";
}



$sql = "SELECT `idproducto_reporte_vencimiento`, 
 producto.codigo,producto.nombre as nombre_producto,
 concat_ws(' ', persona.nombre,persona.apellidos) as nombre_completo,
persona.identificacion,
producto_reporte_vencimiento.fecha_vencimiento,
producto_reporte_vencimiento.cantidad
 FROM `producto_reporte_vencimiento` 

JOIN producto on producto_reporte_vencimiento.idproducto= producto.idproducto
JOIN reporte_vencimiento on producto_reporte_vencimiento.idreporte_vencimiento =
reporte_vencimiento.idreporte_vencimiento
JOIN empleado on reporte_vencimiento.idempleado= empleado.idempleado
JOIN persona ON empleado.idpersona=persona.idpersona
            where true $filtros


            ";


$num_reg_paginas = 4;
$pagina_actual = $_GET['pagina_actual'];

$sql_pedido = "SELECT COUNT(*) FROM ($sql) as t";
$rs_pedido = mysqli_query($conexion, $sql_pedido);
$rw_pedido= mysqli_fetch_row($rs_pedido);
$cantidad_registros = $rw_pedido[0];

$primer_registro = ($pagina_actual - 1) * $num_reg_paginas;


$cantidad_paginas = ceil($cantidad_registros / $num_reg_paginas);


$sql_final = $sql . " LIMIT $primer_registro , $num_reg_paginas  ";
?>

<form id="form-filtro">
    <table class="table table-striped">
        <thead>
            <tr>


                <th scope="col">Num.</th>                
                <th scope="col">Codigo</th>
                <th scope="col">Nombre producto</th>
                <th scope="col">Nombre empleado</th>
                <th scope="col">Identificacion</th>
                             <th scope="col">fecha vencimiento</th>
                <th scope="col">Cantidad</th>
                
                

                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>



 <tr id="tr-filtros"  <?php echo $filtros !='' ?  '' : 'style=

  "display: none;" ' ?> >  
            <th scope="col"> </th>
                  <th scope="col">
                    <input type="text" name="codigo" class="form-control form-control-sm" value="<?php echo isset($_GET['codigo']) ? $_GET['codigo'] : ""  ?>" /></th>
                
                     <th scope="col">
                    <input type="text" name="nombre_producto" class="form-control form-control-sm" value="<?php echo isset($_GET['nombre_producto']) ? $_GET['nombre_producto'] : ""  ?>" /></th>

                    
                <th scope="col"><input type="text" name="nombre_completo" class="form-control form-control-sm" value="<?php echo isset($_GET['nombre_completo']) ? $_GET['nombre_completo'] : ""  ?>" /></th>
                
                                <th scope="col"><input type="text" name="identificacion" class="form-control form-control-sm" value="<?php echo isset($_GET['identificacion']) ? $_GET['identificacion'] : ""  ?>" /></th>

                   
                     <th scope="col">
                    <input type="text" name="fecha_vencimiento" class="form-control form-control-sm" value="<?php echo isset($_GET['fecha_vencimiento']) ? $_GET['fecha_vencimiento'] : ""  ?>" /></th>

                    
                <th scope="col"><input type="text" name="cantidad" class="form-control form-control-sm" value="<?php echo isset($_GET['cantidad']) ? $_GET['cantidad'] : ""  ?>" /></th>
 
            

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
                    
                    <td><?php echo $mostrar['codigo'] ?></td>
                    <td><?php echo $mostrar['nombre_producto'] ?></td>
                    
                    <td><?php echo $mostrar['nombre_completo'] ?></td>
                    <td><?php echo $mostrar['identificacion'] ?></td>
                    <td><?php echo $mostrar['fecha_vencimiento'] ?></td>
                    <td><?php echo $mostrar['cantidad'] ?></td>



                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['idproducto_reporte_vencimiento'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['idproducto_reporte_vencimiento'] ?>')">
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