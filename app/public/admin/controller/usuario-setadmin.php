<?php

session_start();

include ('../layouts/config.php');

// ELIMINAR USUARIO
if (isset($_GET['id_user'])){
    $id = $_GET['id_user'];

    $category = '2';
    $sql = "UPDATE users SET category='$category' WHERE id = $id";
    //echo $sql;
    //die();

    if ($link->query($sql) === TRUE) {
        //echo '<script> alert ("Usuario dado de baja")</script>';
        header("Location: ../apps-contacts-list.php");
    } else {
        echo '<script> alert ("No se pudo setear como Admin")</script>';
    }

// Cerrar la conexión
    $link->close();
}
