<?php
session_start();
$servidor = "127.0.0.1";
$usuario = "root";
$clave = "";
$basedato = "drogueria-inventario";
$puerto = "3306";
$conexion = mysqli_connect($servidor, $usuario, $clave, $basedato, $puerto);
mysqli_set_charset($conexion,"UTF8");

