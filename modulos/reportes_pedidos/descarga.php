<?php
require_once("conexion.php");

ob_start(); //Impedir que el contenido que se genera se vaya directamente al navegador

$filtros = "";

if (isset($_POST['fecha_inicio']) &&  $_POST['fecha_inicio'] != "") {
    $fecha_inicio = $_POST['fecha_inicio'];
    $filtros .= "  AND fecha_pedido >=  '$fecha_inicio'";

}
if (isset($_POST['fecha_hasta']) &&  $_POST['fecha_hasta'] != "") {
    $fecha_hasta = $_POST['fecha_hasta'];
    $filtros .= "  AND  fecha_pedido  <=  '$fecha_hasta'";

}
  


$sql = "SELECT `idpedido_producto`, producto.nombre as nombre_producto , CONCAT_WS(' ',persona.nombre,persona.apellidos) as nombre_proveedor , pedido.fecha_pedido , cantidad,fecha_vencimiento 



FROM `pedido_producto`

JOIN pedido on pedido_producto.idpedido=pedido.idpedido
JOIN proveedor on pedido.idproveedor= proveedor.idproveedor
JOIN persona ON proveedor.idpersona=persona.idpersona
JOIN producto ON pedido_producto.idproducto=producto.idproducto
where true $filtros
        ";
//echo $sql;

?>
<style>
    table {
        border-collapse: collapse;
    }

    th {
        text-align: left;
    }

    table,
    td,
    th {
        border: 0.5pt solid #aaa;
        padding: 3pt;
    }
</style>
<div style="width: 100px;"> <img style="width: 100px;" src="img/medishop.png" /> </div>     
             <h2 style="text-align:center;">Reporte pedido</h2>
<table>


    <thead>

        <tr style="font-weight: bold; background-color: #ddd;">
            <th style="width: 30pt;">Num.</th>
            <th style="width: 170pt;">Nombre proveedor</th>   
                        <th style="width: 100pt;">Nombre producto</th>
                        <th style="width: 80pt;">Fecha vencimiento</th>

             <th style="width: 80pt;">Fecha pedido  </th>
              <th style="width: 60pt;"> Cantidad</th>
      

      
             
        </tr>

    </thead>
    <tbody>
        <?php



        $result = mysqli_query($conexion, $sql);

        $num =   1;
        while ($row = mysqli_fetch_array($result)) {
            if ($num % 2 == 0) {
                $color = "#eeeeee";
            } else {
                $color = "#ffffff";
            }
        ?>


            <tr style="background-color: <?php  echo $color ?>;">
                                <td style="width: 30pt;"><?php echo $num++ ?></td>


                <td style="width: 170pt;"><?php echo $row['nombre_proveedor'] ?></td>
                <td style="width: 100pt;"><?php echo $row['nombre_producto'] ?></td>
                <td style="width: 80pt;"><?php echo $row['fecha_vencimiento'] ?></td>
                <td style="width: 80pt;"><?php echo $row['fecha_pedido'] ?></td>
                <td style="width: 60pt;"><?php echo $row['cantidad'] ?></td>


            </tr>
        <?php
        }
        ?>
    </tbody>

</table>


<?php
$html = ob_get_clean();

$formato = $_POST['formato'];

if ($formato == "word") {
    //Tratar la repuesta del navegador como un archido descargable
    header("Content-Disposition: attachment; filename=reporte_pedido.doc");
    //Decirle al nevegador que el archivo expira en 0 segundo, para que no lo guarde en Cache
    header("Expires: 0");
    //Forzar a pedir de nuevo el archivo, si se hace una nueva solicitud
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

    echo $html;
} else if ($formato == "excel") {

    //Tratar la repuesta del navegador como un archido descargable
    header("Content-Disposition: attachment; filename=reporte_pedido.xls");
    //Decirle al nevegador que el archivo expira en 0 segundo, para que no lo guarde en Cache
    header("Expires: 0");
    //Forzar a pedir de nuevo el archivo, si se hace una nueva solicitud
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

    echo $html;
} else if ($formato == "html") {
    echo $html;
} else if ($formato == "pdf") {
    // Include the main TCPDF library (search for installation path).
    require_once('php/tcpdf/tcpdf.php');

    // create new PDF document
    $pdf = new TCPDF("p", "pt", "letter", true, 'UTF-8', false);

    // set margins
    //Establecer margenes: Izquierdo, Superior, Derecho
    $pdf->SetMargins(40, 80, 40);

    //Establecer margen del encabezado
    $pdf->SetHeaderMargin(30);

    //Establecer margen del pie de pagina

    $pdf->SetFooterMargin(35);

    // set auto page breaks
    // Margen del salto de pagina
    // Debe ser superior o igual al margen del pie de pagina

    $pdf->SetAutoPageBreak(TRUE, 60);


    // set font
    $pdf->SetFont('times', '', 10);

    // add a page
    $pdf->AddPage();

    $pdf->writeHTML($html);


    //Close and output PDF document
    $pdf->Output('reporte_pedido.pdf', 'I');
}

?>