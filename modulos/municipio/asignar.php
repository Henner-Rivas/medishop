<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT idmunicipio,
 municipio.nombre as municipio,
 departamento.iddepartamento as departamento
 FROM municipio
 JOIN departamento on municipio.iddepartamento=departamento.iddepartamento
WHERE idmunicipio='$id' 

     "; 





$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);