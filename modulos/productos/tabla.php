<?php

require_once("conexion.php");

$filtros = "";
if (isset($_GET['codigo']) &&  $_GET['codigo'] != "") {
    $codigo = $_GET['codigo'];
    $codigo = str_replace(" ", "%", $codigo);
    $filtros .= "  AND  producto.codigo LIKE '%$codigo%'";
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
    $filtros .= " AND via_administracion.nombre LIKE '%$via_administracion%'";
}
if (isset($_GET['presentacion']) &&  $_GET['presentacion'] != "") {
    $presentacion = $_GET['presentacion'];
//Buscar espacio y reemplazarlos por %
    $presentacion = str_replace(" ", "%", $presentacion);
    $filtros .= "  AND  presentacion.nombre LIKE '%$presentacion%'";
}

if (isset($_GET['nombre']) &&  $_GET['nombre'] != "") {
    $nombre = $_GET['nombre'];
//Buscar espacio y reemplazarlos por %
    $nombre = str_replace(" ", "%", $nombre);
    $filtros .= "  AND  producto.nombre LIKE '%$nombre%'";
}


if (isset($_GET['iva']) &&  $_GET['iva'] != "") {
    $iva = $_GET['iva'];
//Buscar espacio y reemplazarlos por %
    $iva = str_replace(" ", "%", $iva);
    $filtros .= "  AND producto.iva LIKE '%$iva%'";
}
if (isset($_GET['valor_unitario']) &&  $_GET['valor_unitario'] != "") {
    $valor_unitario = $_GET['valor_unitario'];
//Buscar espacio y reemplazarlos por %
    $valor_unitario = str_replace(" ", "%", $valor_unitario);
    $filtros .= "  AND  producto.valor_unitario LIKE '%$valor_unitario%'";
}




$sql_base = "SELECT `idproducto`,
   codigo, 
    producto.nombre as nombre,
    descripcion,
    unidad_medida.nombre as unidad_medida,
  via_administracion.nombre AS via_administracion,
 presentacion.nombre as presentacion,
  producto.iva as iva,
   valor_unitario
  FROM producto
  join unidad_medida on producto.idunidad_medida= unidad_medida.idunidad_medida
  join via_administracion on producto.idvia_administracion= via_administracion.idvia_administracion
   join presentacion on producto.idpresentacion= presentacion.idpresentacion
            where true $filtros


            ";


$num_reg_paginas = 5;
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
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Unidad de medida</th>
           <th scope="col">Via Administracion</th>
           <th scope="col">Presentacion</th>
            <th scope="col">Iva</th>
            <th scope="col">Valor unitario</th>
            <th scope="col" style="text-align: center;">Acciones</th>

            </tr>



 <tr id="tr-filtros"  <?php echo $filtros !='' ?  '' : 'style=

  "display: none;" ' ?> >  
            <th scope="col"> </th>

                <th scope="col">
                    <input type="text" name="codigo" class="form-control form-control-sm" value="<?php echo isset($_GET['codigo']) ? $_GET['codigo'] : ""  ?>" /></th>
 <th scope="col">
                    <input type="text" name="nombre" class="form-control form-control-sm" value="<?php echo isset($_GET['nombre']) ? $_GET['nombre'] : ""  ?>" /></th>


                <th scope="col"><input type="text" name="unidad_medida" class="form-control form-control-sm" value="<?php echo isset($_GET['unidad_medida']) ? $_GET['unidad_medida'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="via_administracion" class="form-control form-control-sm" value="<?php echo isset($_GET['via_administracion']) ? $_GET['via_administracion'] : ""  ?>" /></th>
                
                 <th scope="col"><input type="text" name="presentacion" class="form-control form-control-sm" value="<?php echo isset($_GET['presentacion']) ? $_GET['presentacion'] : ""  ?>" /></th>


                
                 

                <th scope="col"><input type="text" name="iva" class="form-control form-control-sm" value="<?php echo isset($_GET['iva']) ? $_GET['iva'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="valor_unitario" class="form-control form-control-sm" value="<?php echo isset($_GET['valor_unitario']) ? $_GET['valor_unitario'] : ""  ?>" /></th>

            

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
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['unidad_medida'] ?></td>
                <td><?php echo $mostrar['via_administracion'] ?></td>
                <td><?php echo $mostrar['presentacion'] ?></td>               
                <td><?php echo $mostrar['iva'] ?></td>
                <td><?php echo $mostrar['valor_unitario'] ?></td>



                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['idproducto'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['idproducto'] ?>')">
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