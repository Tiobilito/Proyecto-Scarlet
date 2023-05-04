<?php
session_start();
require('conexion_bd.php');

$connect = conexion_bd();
$correo = $_POST['email_user'] ?? null;
$pass = $_POST['passw_user'] ?? null;
$type = $_POST['type_user'] ?? null;

$sql = "SELECT * FROM usuarios WHERE Email = '$correo' AND Contraseña = '$pass' AND tipoUsuario = '$type' AND statusUsuario = 1";
$resultado = mysqli_query($connect, $sql);
$fila = mysqli_num_rows($resultado);

if($fila <= 0){
    echo 0;
} else{
    $row = mysqli_fetch_assoc($resultado);

    $id = $row['IdUsuario'];
    $nombre = $row['Nombre'].' '.$row['Apellido'];
    $tipo = $type;
    $_SESSION["id"] = $id;
    $_SESSION["nombre"] = $nombre;
    $_SESSION["tipo"] = $tipo;

    switch($type){
        case "0":
            echo 1;
            break;
        case "1":
            echo 2;
            break;
    }
}
?>