<?php

require_once("conexion.php");

$filtros = "";




if (isset($_GET['persona']) &&  $_GET['persona'] != "") {
    $persona = $_GET['persona'];
//Buscar espacio y reemplazarlos por %
    $persona = str_replace(" ", "%", $persona);
    $filtros .= "  AND concat_ws(' ', persona.nombre,persona.apellidos) LIKE '%$persona%'";
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
if (isset($_GET['usuario']) &&  $_GET['usuario'] != "") {
    $usuario = $_GET['usuario'];
//Buscar espacio y reemplazarlos por %
    $usuario = str_replace(" ", "%", $usuario);
    $filtros .= "  AND  usuario.usuario LIKE '%$usuario%'";
}


$sql_base = "SELECT `id_usuario`, 
cargo.nombre as cargo, 
concat_ws('  ', persona.nombre  ,persona.apellidos )  as nombre_completo ,
usuario.clave, 
persona.identificacion ,
usuario.usuario as usuario 
FROM `usuario` 
join persona on usuario.id_persona = persona.idpersona
JOIN cargo on usuario.id_cargo= cargo.idcargo
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
                <th scope="col">Nombre completo</th>
                                <th scope="col">identificacion</th>

                <th scope="col">Cargo</th>
                <th scope="col">Usuario</th>
                <th scope="col">Contraseña</th>
            
                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>



 <tr id="tr-filtros"  <?php echo $filtros !='' ?  '' : 'style=

  "display: none;" ' ?> >  
            <th scope="col"> </th>

                <th scope="col">
                    <input type="text" name="persona" class="form-control form-control-sm" value="<?php echo isset($_GET['persona']) ? $_GET['persona'] : ""  ?>" /></th>

                     <th scope="col"><input type="text" name="identifica" class="form-control form-control-sm" value="<?php echo isset($_GET['identifica']) ? $_GET['identifica'] : ""  ?>" /></th>


                <th scope="col"><input type="text" name="cargo" class="form-control form-control-sm" value="<?php echo isset($_GET['cargo']) ? $_GET['cargo'] : ""  ?>" /></th>      
 <th scope="col">



                    <input type="text" name="usuario" class="form-control form-control-sm" value="<?php echo isset($_GET['usuario']) ? $_GET['usuario'] : ""  ?>" /></th>


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
                    <td><?php echo $mostrar['nombre_completo'] ?></td>
                    <td><?php echo $mostrar['identificacion'] ?></td>
                    <td><?php echo $mostrar['cargo'] ?></td>
                    <td><?php echo $mostrar['usuario'] ?></td>
                    <td><?php echo $mostrar['clave'] ?></td>
             



                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['id_usuario'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['id_usuario'] ?>')">
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