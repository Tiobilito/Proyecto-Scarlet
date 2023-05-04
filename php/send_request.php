<?php
require('conexion_bd.php');
$connect = conexion_bd();

$id_worker = $_POST['id_col'];
$id_client = $_POST['client_id'];
$name_client = $_POST['client_name'];
$title = $_POST['request_title'];
$description = $_POST['request_descript'];

$sql_insert = "INSERT INTO solicitudes VALUES(0, CURRENT_TIMESTAMP, '$name_client', '$title', '$description', '$id_client', '$id_worker', 1)";
$insert = mysqli_query($connect, $sql_insert) or die(mysqli_errno($connect));

if($insert){
    echo 1;
} else{
    echo 0;
}
?>