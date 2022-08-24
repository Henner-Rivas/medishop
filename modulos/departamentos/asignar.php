<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT `iddepartamento`, 
`nombre` as departamento


 FROM `departamento`
WHERE iddepartamento='$id' 

     "; 





$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);