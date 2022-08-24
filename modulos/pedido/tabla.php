<?php

require_once("conexion.php");

$filtros = "";


if (isset($_GET['ncproveedor']) &&  $_GET['ncproveedor'] != "") {
    $ncproveedor = $_GET['ncproveedor'];
//Buscar espacio y reemplazarlos por %
    $ncproveedor = str_replace(" ", "%", $ncproveedor);
    $filtros .= "  AND  concat_ws(' ', persona.nombre,persona.apellidos) LIKE '%$ncproveedor%'";
}
if (isset($_GET['identificacion_proveedor']) &&  $_GET['identificacion_proveedor'] != "") {
    $identificacion_proveedor = $_GET['identificacion_proveedor'];
//Buscar espacio y reemplazarlos por %
    $identificacion_proveedor = str_replace(" ", "%", $identificacion_proveedor);
    $filtros .= "  AND  persona.identificacion LIKE '%$identificacion_proveedor%'";
} 

if (isset($_GET['fecha_pedido']) &&  $_GET['fecha_pedido'] != "") {
    $fecha_pedido = $_GET['fecha_pedido'];
//Buscar espacio y reemplazarlos por %
    $fecha_pedido = str_replace(" ", "%", $fecha_pedido);
    $filtros .= " AND   pedido.fecha_pedido LIKE '%$fecha_pedido%'";
}



$sql_base = "SELECT idpedido,
fecha_pedido as fecha_pedido,
concat_ws(' ', persona.nombre,persona.apellidos) as nombre_completo_proveedor,
persona.identificacion as identificacion_proveedor,

persona.direccion as direccion_proveedor,

persona.email as email_proveedor,
persona.telefono as telefono_proveedor



FROM pedido
 join proveedor on pedido.idproveedor = proveedor.idproveedor
 join persona on proveedor.idpersona=persona.idpersona
 
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
             <th scope="col">Fecha del pedido</th>
            <th scope="col">Proveedor</th>            
            <th scope="col">Identificación</th>
           


                        <th scope="col">Dirección</th>

           
                      <th scope="col">Email</th>
                      <th scope="col">Telefono</th>


                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>



 <tr id="tr-filtros"  <?php echo $filtros !='' ?  '' : 'style=

  "display: none;" ' ?> >  
            <th scope="col"> </th>

                   <th scope="col"><input type="text" name="fecha_pedido" class="form-control form-control-sm" value="<?php echo isset($_GET['fecha_pedido']) ? $_GET['fecha_pedido'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="ncproveedor" class="form-control form-control-sm" value="<?php echo isset($_GET['ncproveedor']) ? $_GET['ncproveedor'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="identificacion_proveedor" class="form-control form-control-sm" value="<?php echo isset($_GET['identificacion_proveedor']) ? $_GET['identificacion_proveedor'] : ""  ?>" /></th>
                
               

                
                             <th scope="col"> </th>
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
                    <td><?php echo $mostrar['fecha_pedido'] ?></td>
                    <td><?php echo $mostrar['nombre_completo_proveedor'] ?></td>
                    <td><?php echo $mostrar['identificacion_proveedor'] ?></td>
                   
                    <td><?php echo $mostrar['direccion_proveedor'] ?></td>
                  
                     <td><?php echo $mostrar['email_proveedor'] ?></td>
                     <td><?php echo $mostrar['telefono_proveedor'] ?></td>



                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['idpedido'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['idpedido'] ?>')">
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