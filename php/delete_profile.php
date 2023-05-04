<?php
require('conexion_bd.php');
$connect = conexion_bd();

$id = $_POST['id'];

$sql_update = "UPDATE usuarios
            SET usuarios.statusUsuario = 0
            WHERE usuarios.IdUsuario = '$id'";
$res = mysqli_query($connect, $sql_update) or trigger_error(mysqli_errno($connect));

echo 1;
?>