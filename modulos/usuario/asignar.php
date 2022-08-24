<?php
require_once("conexion.php");

$id = $_GET['id'];

$sql = "SELECT `id_usuario`, 
cargo.idcargo, 
persona.idpersona ,
usuario.clave, 
persona.identificacion ,
usuario.usuario as usuario 
FROM `usuario` 
join persona on usuario.id_persona = persona.idpersona
JOIN cargo on usuario.id_cargo= cargo.idcargo


     WHERE id_usuario='$id' "; 

 



$rs = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_assoc($rs);

echo json_encode($rw);