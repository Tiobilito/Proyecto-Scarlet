<?php
require('conexion_bd.php');
$connect = conexion_bd();

$status = $_POST['request_status'];
$id = $_POST['id'];

switch($status){
    case '2': 
        $sql_update = "UPDATE solicitudes
                    INNER JOIN trabajadores ON solicitudes.id_trabajador = trabajadores.IdUsuario
                    SET solicitudes.status_solicitud = 2
                    WHERE trabajadores.IdUsuario = '$id'";
        $res = mysqli_query($connect, $sql_update) or trigger_error(mysqli_errno($connect));

        echo 1;
    break;
    case '3':
        $sql_update = "UPDATE solicitudes
                    INNER JOIN trabajadores ON solicitudes.id_trabajador = trabajadores.IdUsuario
                    SET solicitudes.status_solicitud = 3
                    WHERE trabajadores.IdUsuario = '$id'";
        $res = mysqli_query($connect, $sql_update) or trigger_error(mysqli_errno($connect));

        echo 1;
    break;
    case '4':
        $sql_update = "UPDATE solicitudes
                    INNER JOIN trabajadores ON solicitudes.id_trabajador = trabajadores.IdUsuario
                    SET solicitudes.status_solicitud = 4
                    WHERE trabajadores.IdUsuario = '$id'";
        $res = mysqli_query($connect, $sql_update) or trigger_error(mysqli_errno($connect));
        echo 1;
}
?>