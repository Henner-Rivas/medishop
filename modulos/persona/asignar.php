<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT 
            idpersona,
            idtipoidentificacion,
            identificacion,
            nombre,
            apellidos,
            direccion,
            email,
            idmunicipio_expedicion,
            telefono
        FROM
            persona
        WHERE idpersona='$id' ";




$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);