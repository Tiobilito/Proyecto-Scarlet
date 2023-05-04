<?php
session_start();
require('conexion_bd.php');

$connect = conexion_bd();
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$type = $_POST['type'];
$passw = $_POST['passwconf'];

$sql = "SELECT * FROM usuarios WHERE Email = '$email'";
$resultado = mysqli_query($connect, $sql);
$fila = mysqli_num_rows($resultado);

if($fila > 0){
    echo 2; 
} else{
    $nombre = $name.' '.$lastname;
    $tipo = $type;
    $_SESSION["nombre"] = $nombre;
    $_SESSION["tipo"] = $tipo;

    $sql_insert = "INSERT INTO usuarios
        VALUES(0, '$type', '$name', '$lastname', '$username', '$phone', '$email', '$passw', 1)";
    $insert = mysqli_query($connect, $sql_insert) or die(mysqli_errno($connect));

    switch($type){
        case 0:
            echo 0;
            break;
        case 1:
            echo 1;
            break;
    }
}
?>