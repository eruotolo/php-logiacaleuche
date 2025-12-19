<?php

session_start();

include ('../layouts/config.php');

// ELIMINAR USUARIO
if (isset($_GET['id_user'])){
    $id = $_GET['id_user'];
    $password = 'Guns026772';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $estado = '0';

    $sql = "UPDATE users SET password='$hash', estado = '$estado' WHERE id = $id";
    //echo $sql;
    //die();

    if ($link->query($sql) === TRUE) {
        //echo '<script> alert ("Usuario dado de baja")</script>';
        header("Location: ../apps-contacts-list.php");
    } else {
        echo '<script> alert ("No se pudo dar de baja al usuario")</script>';
    }

// Cerrar la conexión
    $link->close();

}


