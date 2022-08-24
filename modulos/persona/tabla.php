<?php

require_once("conexion.php");

$filtros = "";
if (isset($_GET['tipo_identificacion']) &&  $_GET['tipo_identificacion'] != "") {
    $tipo_identificacion = $_GET['tipo_identificacion'];
    $tipo_identificacion = str_replace(" ", "%", $tipo_identificacion);
    $filtros .= "  AND  tipo_identificacion.nombre LIKE '%$tipo_identificacion%'";
}

if (isset($_GET['identificacion']) &&  $_GET['identificacion'] != "") {
    $identificacion = $_GET['identificacion'];
//Buscar espacio y reemplazarlos por %
    $identificacion = str_replace(" ", "%", $identificacion);
    $filtros .= "  AND  identificacion LIKE '%$identificacion%'";
}

if (isset($_GET['nombre_completo']) &&  $_GET['nombre_completo'] != "") {
    $nombre_completo = $_GET['nombre_completo'];
//Buscar espacio y reemplazarlos por %
    $nombre_completo = str_replace(" ", "%", $nombre_completo);
    $filtros .= "  AND  CONCAT_WS(' ',persona.nombre,persona.apellidos) LIKE '%$nombre_completo%'";
}
if (isset($_GET['direccion']) &&  $_GET['direccion'] != "") {
    $direccion = $_GET['direccion'];
//Buscar espacio y reemplazarlos por %
    $direccion = str_replace(" ", "%", $direccion);
    $filtros .= "  AND  persona.direccion LIKE '%$direccion%'";
}

if (isset($_GET['email']) &&  $_GET['email'] != "") {
    $email = $_GET['email'];
//Buscar espacio y reemplazarlos por %
    $email = str_replace(" ", "%", $email);
    $filtros .= "  AND  persona.email LIKE '%$email%'";
}


if (isset($_GET['municipio']) &&  $_GET['municipio'] != "") {
    $municipio = $_GET['municipio'];
//Buscar espacio y reemplazarlos por %
    $municipio = str_replace(" ", "%", $municipio);
    $filtros .= "  AND municipio.nombre LIKE '%$municipio%'";
}
if (isset($_GET['telefono']) &&  $_GET['telefono'] != "") {
    $telefono = $_GET['telefono'];
//Buscar espacio y reemplazarlos por %
    $telefono = str_replace(" ", "%", $telefono);
    $filtros .= "  AND  persona.telefono LIKE '%$telefono%'";
}




$sql_base = "SELECT idpersona,
                tipo_identificacion.nombre as tipo_identificacion,
                identificacion,
                CONCAT_WS(' ',persona.nombre,persona.apellidos) as nombre_completo,
                direccion,
                email,
                municipio.nombre as municipio,
                telefono
                from persona
                join tipo_identificacion on  persona.idtipoidentificacion=tipo_identificacion.idtipo_identificacion
                 join municipio on persona.idmunicipio_expedicion=municipio.idmunicipio
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
                 <th scope="col">Tipo de identificación</th>
            <th scope="col">Identificación</th>
            <th scope="col">Nombre completo</th>
           <th scope="col">Direccion</th>
           <th scope="col">Email</th>
            <th scope="col">Municipio</th>
            <th scope="col">Telefono</th>
            <th scope="col" style="text-align: center;">Acciones</th>

            </tr>



 <tr id="tr-filtros"  <?php echo $filtros !='' ?  '' : 'style=

  "display: none;" ' ?> >  
            <th scope="col"> </th>

                <th scope="col">
                    <input type="text" name="tipo_identificacion" class="form-control form-control-sm" value="<?php echo isset($_GET['tipo_identificacion']) ? $_GET['tipo_identificacion'] : ""  ?>" /></th>
 <th scope="col">
                    <input type="text" name="identificacion" class="form-control form-control-sm" value="<?php echo isset($_GET['identificacion']) ? $_GET['identificacion'] : ""  ?>" /></th>


                <th scope="col"><input type="text" name="nombre_completo" class="form-control form-control-sm" value="<?php echo isset($_GET['nombre_completo']) ? $_GET['nombre_completo'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="direccion" class="form-control form-control-sm" value="<?php echo isset($_GET['direccion']) ? $_GET['direccion'] : ""  ?>" /></th>
                
                 <th scope="col"><input type="text" name="email" class="form-control form-control-sm" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ""  ?>" /></th>


                
                 

                <th scope="col"><input type="text" name="municipio" class="form-control form-control-sm" value="<?php echo isset($_GET['municipio']) ? $_GET['municipio'] : ""  ?>" /></th>

                <th scope="col"><input type="text" name="telefono" class="form-control form-control-sm" value="<?php echo isset($_GET['telefono']) ? $_GET['telefono'] : ""  ?>" /></th>

            

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
                <td><?php echo $mostrar['tipo_identificacion'] ?></td>
                <td><?php echo $mostrar['identificacion'] ?></td>
                <td><?php echo $mostrar['nombre_completo'] ?></td>
                <td><?php echo $mostrar['direccion'] ?></td>
                <td><?php echo $mostrar['email'] ?></td>               
                <td><?php echo $mostrar['municipio'] ?></td>
                <td><?php echo $mostrar['telefono'] ?></td>




                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['idpersona'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['idpersona'] ?>')">
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