<?php
require_once("conexion.php");

$id = $_GET['id'];



$sql = "SELECT 
           idproducto,
            codigo, 
         nombre, 
         descripcion, 
         idunidad_medida,
         idvia_administracion,
          idpresentacion, 
          iva,
          valor_unitario
        FROM
            producto
        WHERE idproducto='$id'";




$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);