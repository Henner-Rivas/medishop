<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT 
            contenido_id, modulo, titulo, contenido
        FROM
            contenido
                WHERE contenido_id='$id' ";




$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);