<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT id_permiso_cargo,id_cargo, modulo, accion FROM permiso_cargo
     WHERE id_permiso_cargo='$id' "; 

$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);