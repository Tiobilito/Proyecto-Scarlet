<?php
define("HOST", 'localhost');
define("BD", 'id19606534_proyectscarlett');
define("USER_BD", 'root');
define("PASS_BD", '');

function conexion_bd(){
    if(!($con = mysqli_connect(HOST, USER_BD, PASS_BD, BD))){
        echo "Error conectando al Servidor de BBDD";
        exit();
    }

    if(!mysqli_select_db($con, BD)){
        echo "Error seleccionando BD";
        exit();
    }

    return $con;
}

?>