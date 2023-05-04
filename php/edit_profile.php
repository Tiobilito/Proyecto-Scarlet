<?php
require('conexion_bd.php');
$connect = conexion_bd();

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$job = $_POST['job'];
$id_user = $_POST['id'];
$address = $_POST['address'];

$sql_correo = "SELECT * FROM usuarios WHERE Email = '$email'";
$resultado = mysqli_query($connect, $sql_correo);
$fila = mysqli_num_rows($resultado);

if($fila > 0){
    $sql_update = "UPDATE trabajadores
                INNER JOIN usuarios ON usuarios.IdUsuario = trabajadores.IdUsuario
                SET trabajadores.IdJobs = 0, trabajadores.IdUsuario = '$id_user', usuarios.IdUsuario = '$id_user', usuarios.Nombre = '$name',
                    usuarios.Apellido = '$lastname', usuarios.UserName = '$username', usuarios.Telefono = '$phone',
                    usuarios.Email = '$email', trabajadores.Domicilio = '$address', trabajadores.Municipio = '$location',
                    trabajadores.Oficio = '$job', trabajadores.Tel_Loc = '$phone'
                WHERE trabajadores.IdUsuario = '$id_user'";
    $res = mysqli_query($connect, $sql_update) or trigger_error(mysqli_errno($connect));

    echo 1;
} else{
    echo 0;
}
?>