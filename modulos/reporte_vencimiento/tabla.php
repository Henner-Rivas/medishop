<?php

require_once("conexion.php");

$filtros = "";
if (isset($_GET['nombre_completo']) &&  $_GET['nombre_completo'] != "") {
    $nombre_completo = $_GET['nombre_completo'];
//Buscar espacio y reemplazarlos por %
    $nombre_completo = str_replace(" ", "%", $nombre_completo);
    $filtros .= "  AND  concat_ws(' ', persona.nombre,persona.apellidos) LIKE '%$nombre_completo%'";
}
if (isset($_GET['telefono']) &&  $_GET['telefono'] != "") {
    $telefono = $_GET['telefono'];
    $telefono = str_replace(" ", "%", $telefono);
    $filtros .= "  AND  persona.telefono LIKE '%$telefono%'";
}


if (isset($_GET['identificacion']) &&  $_GET['identificacion'] != "") {
    $identificacion = $_GET['identificacion'];
//Buscar espacio y reemplazarlos por %
    $identificacion = str_replace(" ", "%", $identificacion);
    $filtros .= "  AND persona.identificacion LIKE '%$identificacion%'";
}

if (isset($_GET['email']) &&  $_GET['email'] != "") {
    $email = $_GET['email'];
    $email = str_replace(" ", "%", $email);
    $filtros .= "  AND  persona.email LIKE '%$email%'";
}




if (isset($_GET['municipio_expedicion']) &&  $_GET['municipio_expedicion'] != "") {
    $municipio_expedicion = $_GET['municipio_expedicion'];
//Buscar espacio y reemplazarlos por %
    $municipio_expedicion = str_replace(" ", "%", $municipio_expedicion);
    $filtros .= "  AND municipio.nombre LIKE '%$municipio_expedicion%'";
}



$sql = "SELECT `idreporte_vencimiento`,
concat_ws(' ', persona.nombre,persona.apellidos) as nombre_completo,
 persona.identificacion,
  persona.telefono,
   persona.email, 
   municipio.nombre as municipio_expedicion


    FROM `reporte_vencimiento` JOIN empleado on reporte_vencimiento.idempleado=empleado.idempleado JOIN persona on empleado.idpersona= persona.idpersona JOIN municipio on persona.idmunicipio_expedicion= municipio.idmunicipio

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
                <th scope="col">Nombre completo</th>
                <th scope="col">Identificacion</th>
                <th scope="col">telefono</th>
                <th scope="col">email</th>
                             <th scope="col">municipio expedicion</th>
                
                

                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>



            <tr id="tr-filtros" style="display: none;">
 
            <th scope="col"> </th>
                 
                    
                <th scope="col"><input type="text" name="nombre_completo" class="form-control form-control-sm" value="<?php echo isset($_GET['nombre_completo']) ? $_GET['nombre_completo'] : ""  ?>" /></th>
                
                                <th scope="col"><input type="text" name="identificacion" class="form-control form-control-sm" value="<?php echo isset($_GET['identificacion']) ? $_GET['identificacion'] : ""  ?>" /></th>

                   
                     <th scope="col">
                    <input type="text" name="telefono" class="form-control form-control-sm" value="<?php echo isset($_GET['telefono']) ? $_GET['telefono'] : ""  ?>" /></th>

                    
                <th scope="col"><input type="text" name="email" class="form-control form-control-sm" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ""  ?>" /></th>
 
             <th scope="col">
                    <input type="text" name="municipio_expedicion" class="form-control form-control-sm" value="<?php echo isset($_GET['municipio_expedicion']) ? $_GET['municipio_expedicion'] : ""  ?>" /></th>
                
              


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
                    
                    <td><?php echo $mostrar['nombre_completo'] ?></td>
                    <td><?php echo $mostrar['identificacion'] ?></td>
                    
                    <td><?php echo $mostrar['telefono'] ?></td>
                    <td><?php echo $mostrar['email'] ?></td>
                    <td><?php echo $mostrar['municipio_expedicion'] ?></td>



                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['idreporte_vencimiento'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['idreporte_vencimiento'] ?>')">
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