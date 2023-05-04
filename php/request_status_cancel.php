<?php
require('conexion_bd.php');
$connect = conexion_bd();

$status = $_POST['request_status'];
$id = $_POST['id'];

$sql_update = "UPDATE solicitudes
            INNER JOIN usuarios ON solicitudes.id_usuario_solicitante = usuarios.IdUsuario
            SET solicitudes.status_solicitud = 5
            WHERE usuarios.IdUsuario = '$id'";
$res = mysqli_query($connect, $sql_update) or trigger_error(mysqli_errno($connect));

echo 1;
?>