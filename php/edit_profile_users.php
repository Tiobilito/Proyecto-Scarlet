<?php
require('conexion_bd.php');
$connect = conexion_bd();

$id_user = $_POST['id'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql_correo = "SELECT * FROM usuarios WHERE Email = '$email'";
$resultado = mysqli_query($connect, $sql_correo);
$fila = mysqli_num_rows($resultado);

if($fila > 0){
    $sql_update = "UPDATE usuarios
                    SET IdUsuario = '$id_user', Nombre = '$name', Apellido = '$lastname', UserName = '$username',
                    Telefono = '$phone', Email = '$email'
                    WHERE IdUsuario = '$id_user'";
    $res = mysqli_query($connect, $sql_update) or trigger_error(mysqli_errno($connect));

    echo 1;
} else{
    echo 0;
}
?>