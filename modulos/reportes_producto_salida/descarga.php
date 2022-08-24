<?php
require_once("conexion.php");

ob_start(); //Impedir que el contenido que se genera se vaya directamente al navegador

$filtros = "";

if (isset($_POST['fecha_inicio']) &&  $_POST['fecha_inicio'] != "") {
    $fecha_inicio = $_POST['fecha_inicio'];
    $filtros .= "  AND fecha >=  '$fecha_inicio'";

}
if (isset($_POST['fecha_hasta']) &&  $_POST['fecha_hasta'] != "") {
    $fecha_hasta = $_POST['fecha_hasta'];
    $filtros .= "  AND  fecha  <=  '$fecha_hasta'";

}

$sql = "SELECT producto.codigo,producto.nombre as producto,
salida.fecha ,

 sum(cantidad) as mas_vendido ,
 descripcion 

FROM `producto_salida` JOIN producto ON producto_salida.idproducto= producto.idproducto 
    JOIN salida on producto_salida.idsalida= salida.idsalida 
    
        WHERE true $filtros

GROUP BY producto ORDER BY mas_vendido DESC

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
             <h2 style="text-align:center;">Reporte salida</h2>
<table>


    <thead>

        <tr style="font-weight: bold; background-color: #ddd;">
            <th style="width: 30pt;">Num.</th>
                         <th style="width: 80pt;">Codigo</th>

            <th style="width: 130pt;">Producto.</th>
                        <th style="width: 200pt;">Descripcion</th>   

            <th style="width: 80pt;">Cantidad ventas</th>   

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

                <td style="width: 80pt;"><?php echo $row['codigo'] ?></td>

                <td style="width: 130pt;"><?php echo $row['producto'] ?></td>
                                <td style="width: 200pt;"><?php echo $row['descripcion'] ?></td>

                <td style="width: 80pt;"><?php echo $row['mas_vendido'] ?></td>
            

            


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
    header("Content-Disposition: attachment; filename=reporte_mas_salidas.doc");
    //Decirle al nevegador que el archivo expira en 0 segundo, para que no lo guarde en Cache
    header("Expires: 0");
    //Forzar a pedir de nuevo el archivo, si se hace una nueva solicitud
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

    echo $html;
} else if ($formato == "excel") {

    //Tratar la repuesta del navegador como un archido descargable
    header("Content-Disposition: attachment; filename=reporte_mas_salidas.xls");
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
    $pdf->Output('reporte_mas_salidas.pdf', 'I');
}

?>