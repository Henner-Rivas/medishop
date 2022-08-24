<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idreporte_vencimiento,
reporte_vencimiento.idempleado
  


 FROM reporte_vencimiento
           
             WHERE idreporte_vencimiento='$id' "; 


    



$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);