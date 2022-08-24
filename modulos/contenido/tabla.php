<?php
require_once("conexion.php");

$filtros = "";
if (isset($_GET['cmodulo']) &&  $_GET['cmodulo'] != "") {
    $cmodulo = $_GET['cmodulo'];
    $cmodulo = str_replace(" ", "%", $cmodulo);
    $filtros .= "  AND  modulo LIKE '%$cmodulo%'";
}

if (isset($_GET['titulo']) &&  $_GET['titulo'] != "") {
    $titulo = $_GET['titulo'];
//Buscar espacio y reemplazarlos por %
    $titulo = str_replace(" ", "%", $titulo);
    $filtros .= "  AND  titulo LIKE '%$titulo%'";
}
if (isset($_GET['contenido']) &&  $_GET['contenido'] != "") {
    $contenido = $_GET['contenido'];
//Buscar espacio y reemplazarlos por %
    $contenido = str_replace(" ", "%", $contenido);
    $filtros .= "  AND  contenido LIKE '%$contenido%'";
}
$sql_base = "SELECT `contenido_id`, `modulo`, `titulo`, `contenido` 
FROM `contenido`
                         where true $filtros

       
        ";



$num_reg_paginas = 2;
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
                <th scope="col">Modulo</th>
                <th scope="col">Titulo</th>
                <th scope="col">Contenido</th>

                
                

                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>



  <tr id="tr-filtros"  <?php echo $filtros !='' ?  '' : 'style=

  "display: none;" ' ?> > 
 
            <th scope="col"> </th>

                
                       <th scope="col">
                    <input type="text" name="cmodulo" class="form-control form-control-sm" value="<?php echo isset($_GET['cmodulo']) ? $_GET['cmodulo'] : ""  ?>" /></th>

                    
                <th scope="col"><input type="text" name="titulo" class="form-control form-control-sm" value="<?php echo isset($_GET['titulo']) ? $_GET['titulo'] : ""  ?>" /></th>

                         
                <th scope="col"><input type="text" name="contenido" class="form-control form-control-sm" value="<?php echo isset($_GET['contenido']) ? $_GET['contenido'] : ""  ?>" /></th>

                  

            
      <th scope="col" style="text-align: center;">

                    <button type="button" class="btn btn-sm btn-primary" onclick="mover_pagina('1')">
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
                    
                    <td><?php echo $mostrar['modulo'] ?></td>
                    <td><?php echo $mostrar['titulo'] ?></td>
                 <td><?php echo $mostrar['contenido'] ?></td>





                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modificar('<?php echo $mostrar['contenido_id'] ?>')">
                            <i class="fas fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminar('<?php echo $mostrar['contenido_id'] ?>')">
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