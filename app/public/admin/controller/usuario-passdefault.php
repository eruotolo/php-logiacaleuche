<?php

session_start();

include ('../layouts/config.php');

// ELIMINAR PASS DEFAULT
if (isset($_GET['id_user'])){
    $id = $_GET['id_user'];
    $password = 'LogiaCaleuche_2023';
    $hash = password_hash($password, PASSWORD_DEFAULT);


    $sql = "UPDATE users SET password='$hash' WHERE id = $id";
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
