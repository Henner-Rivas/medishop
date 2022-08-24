<?php
require_once("conexion.php");

ob_start(); //Impedir que el contenido que se genera se vaya directamente al navegador

 $filtros="";
if (isset($_POST['identificacion']) &&  $_POST['identificacion'] != "") {
    $identificacion = $_POST['identificacion'];
    $filtros .= "  AND  persona.identificacion LIKE '%$identificacion%'";
}

$sql = "SELECT 
idproveedor,
         
            persona.nombre,persona.apellidos,
  
             persona.identificacion as identificacion,
 
            persona.direccion as direccion,
            persona.email as email,
            persona.telefono as telefono

            FROM proveedor

            join persona on proveedor.idpersona=persona.idpersona

            WHERE TRUE $filtros
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
             <h2 style="text-align:center;">Reporte proveedores</h2>
<table>


    <thead>

        <tr style="font-weight: bold; background-color: #ddd;">
            <th style="width: 30pt;">Num.</th>
            <th style="width: 70pt;">Identifi.</th>
            <th style="width: 80pt;">Nombre</th>   
             <th style="width: 80pt;">Apellido</th>
              <th style="width: 70pt;">Telefono</th>
             <th style="width: 80pt;">Direccion</th>
              <th style="width: 90pt;">Email</th>
             
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


                <td style="width: 70pt;"><?php echo $row['identificacion'] ?></td>
                <td style="width: 80pt;"><?php echo $row['nombre'] ?></td>
            

                <td style="width: 80pt;"><?php echo $row['apellidos'] ?></td>
                <td style="width: 70pt;"><?php echo $row['telefono'] ?></td>
                <td style="width: 80pt;"><?php echo $row['direccion'] ?></td>
                <td style="width: 90pt;"><?php echo $row['email'] ?></td>


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
    header("Content-Disposition: attachment; filename=reporte_proveedor.doc");
    //Decirle al nevegador que el archivo expira en 0 segundo, para que no lo guarde en Cache
    header("Expires: 0");
    //Forzar a pedir de nuevo el archivo, si se hace una nueva solicitud
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

    echo $html;
} else if ($formato == "excel") {

    //Tratar la repuesta del navegador como un archido descargable
    header("Content-Disposition: attachment; filename=reporte_proveedor.xls");
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
    $pdf->Output('reporte_proveedor.pdf', 'I');
}

?>