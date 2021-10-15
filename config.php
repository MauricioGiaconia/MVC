<?php
    $db_host = "localhost";
    $db_usuario = "root";
    $db_password = "";
    $db_nombre = "tpe";
    $db_connection = mysqli_connect($db_host, $db_usuario, $db_password, $db_nombre);
   
    if(!$db_connection){
        die('No se pudo conectar a la base de datos.' . mysqli_connect_error());
    } 
 
?>