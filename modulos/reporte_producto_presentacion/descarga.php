<?php
ob_start(); //Impedir que el contenido que se genera se vaya directamente al navegador

$filtros = "";

if (isset($_POST['presentacion']) &&  $_POST['presentacion'] != "") {
    $presentacion = $_POST['presentacion'];
    $filtros .= "  AND  presentacion.idpresentacion =  '$presentacion'";
}



$sql = "SELECT idreporte_producto,
            producto.codigo as codigo_producto,
            cantidad_actual as cantidad_actual,
            producto.nombre as nombre_producto,
            unidad_medida.nombre as unidad_medida,
            via_administracion.nombre as via_administracion,
            presentacion.nombre as presentacion, 
            concat_ws(' ', persona.nombre,persona.apellidos) as nombre_completo_empleado,
            cargo.nombre as cargo
      

            FROM reporte_prodcuto

            join empleado on reporte_prodcuto.idempleado=empleado.idempleado
            join persona on empleado.idpersona=persona.idpersona
            join cargo on empleado.idcargo=cargo.idcargo
            join producto on reporte_prodcuto.idproducto=producto.idproducto
            join unidad_medida on producto.idunidad_medida=unidad_medida.idunidad_medida
            join via_administracion on producto.idvia_administracion = via_administracion.idvia_administracion
            join presentacion on producto.idpresentacion = presentacion.idpresentacion
            where true $filtros
         ORDER BY cantidad_actual desc
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
             <h2 style="text-align:center;">Reporte producto</h2>
<table>

    <thead>
        <tr style="font-weight: bold; background-color: #ddd;">

            <th style="width: 30pt;">Num.</th>
            <th style="width: 70pt;">Nombre del producto</th>
            <th style="width: 70pt;">Unidad de medida</th>
            <th style="width: 70px;">Presentacion</th>
            <th style="width: 75px;">Via administracion</th>

            <th style="width: 100px;">Nombre del empleado</th>
                        <th style="width: 60px;">Cargo</th>

          <th style="width: 50pt;">Cantidad actual</th>




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

                <td style="width: 70pt;"><?php echo $row['nombre_producto'] ?></td>
                <td style="width: 70pt;"><?php echo $row['unidad_medida'] ?></td>

                <td style="width: 70pt;"><?php echo $row['presentacion'] ?></td>
                <td style="width: 75pt;"><?php echo $row['via_administracion'] ?></td>

                <td style="width: 100pt;"><?php echo $row['nombre_completo_empleado'] ?></td>
                <td style="width: 60pt;"><?php echo $row['cargo'] ?></td>
                <td style="width: 50pt;"><?php echo $row['cantidad_actual'] ?></td>

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
    header("Content-Disposition: attachment; filename=reporte_prodcuto.doc");
    //Decirle al nevegador que el archivo expira en 0 segundo, para que no lo guarde en Cache
    header("Expires: 0");
    //Forzar a pedir de nuevo el archivo, si se hace una nueva solicitud
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

    echo $html;
} else if ($formato == "excel") {

    //Tratar la repuesta del navegador como un archido descargable
    header("Content-Disposition: attachment; filename=Select MAX(id_plan) as MAX from   reporte_prodcuto.xls");
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
    $pdf->Output('reporte_prodcuto.pdf', 'I');
}

?>