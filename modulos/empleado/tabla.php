<?php

require_once("conexion.php");

$filtros = "";
if (isset($_GET['idpersona']) &&  $_GET['idpersona'] != "") {
    $idpersona = $_GET['idpersona'];
    $idpersona = str_replace(" ", "%", $idpersona);
    $filtros .= "  AND  concat_ws(' ', persona.nombre,persona.apellidos) LIKE '%$idpersona%'";
}

if (isset($_GET['idcargo']) &&  $_GET['idcargo'] != "") {
    $idcargo = $_GET['idcargo'];
//Buscar espacio y reemplazarlos por %
    $idcargo = str_replace(" ", "%", $idcargo);
    $filtros .= "  AND  cargo.nombre LIKE '%$idcargo%'";
}



$sql = "SELECT idempleado,
concat_ws(' ', persona.nombre,persona.apellidos) as empleado,
            cargo.nombre as cargo

            FROM empleado
            
            JOIN persona on empleado.idpersona=persona.idpersona
            JOIN cargo on empleado.idcargo=cargo.idcargo
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
                <th scope="col">Empleado</th>
                <th scope="col">Cargo</th>

                
                

                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>



 <tr id="tr-filtros"  <?php echo $filtros !='' ?  '' : 'style=

  "display: none;" ' ?> >  
            <th scope="col"> </th>

                
 <th scope="col">
                    <input type="text" name="idpersona" class="form-control form-control-sm" value="<?php echo isset($_GET['idpersona']) ? $_GET['idpersona'] : ""  ?>" /></th>

                    
                <th scope="col"><input type="text" name="idcargo" class="form-control form-control-sm" value="<?php echo isset($_GET['idcargo']) ? $_GET['idcargo'] : ""  ?>" /></th>

                   
                  

            

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
                    
                    <td><?php echo $mostrar['empleado'] ?></td>
                    <td><?php echo $mostrar['cargo'] ?></td>
                    




                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['idempleado'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['idempleado'] ?>')">
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