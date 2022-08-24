<?php

require_once("conexion.php");

$filtros = "";
if (isset($_GET['cproducto']) &&  $_GET['cproducto'] != "") {
    $cproducto = $_GET['cproducto'];
    $cproducto = str_replace(" ", "%", $cproducto);
    $filtros .= "  AND  producto.codigo LIKE '%$cproducto%'";
}

if (isset($_GET['nproducto']) &&  $_GET['nproducto'] != "") {
    $nproducto = $_GET['nproducto'];
//Buscar espacio y reemplazarlos por %
    $nproducto = str_replace(" ", "%", $nproducto);
    $filtros .= "  AND  producto.nombre LIKE '%$nproducto%'";
}
if (isset($_GET['descripcion_producto']) &&  $_GET['descripcion_producto'] != "") {
    $descripcion_producto = $_GET['descripcion_producto'];
//Buscar espacio y reemplazarlos por %
    $descripcion_producto = str_replace(" ", "%", $descripcion_producto);
    $filtros .= "  AND  producto.descripcion LIKE '%$descripcion_producto%'";
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



$sql_base = "SELECT idproducto_salida,
            producto.codigo as codigo_producto,
            producto.nombre as nombre_producto,
            producto.descripcion,
            unidad_medida.nombre as unidad_medida,
            via_administracion.nombre as via_administracion,
            presentacion.nombre as presentacion, 
            producto.iva as iva,
            salida.fecha as fecha,
            cantidad
          
            
           

            FROM producto_salida

    
            join producto on producto_salida.idproducto=producto.idproducto
            join unidad_medida on producto.idunidad_medida=unidad_medida.idunidad_medida
            join via_administracion on producto.idvia_administracion = via_administracion.idvia_administracion
            join presentacion on producto.idpresentacion = presentacion.idpresentacion
           join salida on producto_salida.idsalida=salida.idsalida
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
                <th scope="col">Nombre del producto</th>
                
                  <th scope="col">Descripción</th>
                <th scope="col">Unidad de medida</th>
                  <th scope="col">Via de administración</th>
                <th scope="col">Fecha de salida</th>
                <th scope="col">Cantidad</th>

                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>



 <tr id="tr-filtros"  <?php echo $filtros !='' ?  '' : 'style=

  "display: none;" ' ?> >  
            <th scope="col"> </th>

               

                <th scope="col">
                    <input type="text" name="cproducto" class="form-control form-control-sm" value="<?php echo isset($_GET['cproducto']) ? $_GET['cproducto'] : ""  ?>" /></th>
                      <th scope="col"><input type="text" name="nproducto" class="form-control form-control-sm" value="<?php echo isset($_GET['nproducto']) ? $_GET['nproducto'] : ""  ?>" /></th>
                      <th scope="col"><input type="text" name="descripcion_producto" class="form-control form-control-sm" value="<?php echo isset($_GET['descripcion_producto']) ? $_GET['descripcion_producto'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="unidad_medida" class="form-control form-control-sm" value="<?php echo isset($_GET['unidad_medida']) ? $_GET['unidad_medida'] : ""  ?>" /></th>
                
                 <th scope="col"><input type="text" name="via_administracion" class="form-control form-control-sm" value="<?php echo isset($_GET['via_administracion']) ? $_GET['via_administracion'] : ""  ?>" /></th>

                        <th scope="col"> </th>
            <th scope="col"> </th>


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
                    <td><?php echo $mostrar['nombre_producto'] ?></td>
                    
                       <td><?php echo $mostrar['descripcion'] ?></td>
                    <td><?php echo $mostrar['unidad_medida'] ?></td>
                    <td><?php echo $mostrar['via_administracion'] ?></td>
                    <td><?php echo $mostrar['fecha'] ?></td>
                    <td><?php echo $mostrar['cantidad'] ?></td>




                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['idproducto_salida'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['idproducto_salida'] ?>')">
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