<?php
require('conexion_bd.php');
$connect = conexion_bd();

$new_passw_confirm = $_POST['new_passw_confirm'];
$id = $_POST['id'];

$sql_correo = "SELECT * FROM usuarios";
$resultado = mysqli_query($connect, $sql_correo);
$fila = mysqli_num_rows($resultado);

if($fila > 0){
    $sql_pass = "UPDATE usuarios SET usuarios.Contraseña = '$new_passw_confirm' WHERE usuarios.IdUsuario = '$id'";
    $res = mysqli_query($connect, $sql_pass) or trigger_error(mysqli_errno($connect));

    echo 1;
} else{
    echo 0;
}
?>