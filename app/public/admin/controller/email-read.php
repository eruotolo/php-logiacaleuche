<?php

session_start();

include ('../layouts/config.php');

// ELIMINAR USUARIO
if (isset($_GET['id_Message'])){
    $id_Message = $_GET['id_Message'];
    $status_Message = '1';

    $sql = "UPDATE message SET status_Message='$status_Message' WHERE id_Message = $id_Message";
//    echo $sql;
//    die();

    if ($link->query($sql) === TRUE) {
        //echo '<script> alert ("Usuario dado de baja")</script>';
        header("Location: ../apps-email-inbox.php");
    } else {
        echo '<script> alert ("Problemas al dar leer mensaje")</script>';
    }

// Cerrar la conexión
    $link->close();

}
