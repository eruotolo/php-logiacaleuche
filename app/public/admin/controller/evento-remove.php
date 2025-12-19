<?php

session_start();

include ('../layouts/config.php');

if (isset($_GET['id_Evento'])){
    $id_Evento = $_GET['id_Evento'];
    $estado_Evento = 0;

    $sql = "UPDATE evento SET estado_Evento='$estado_Evento' WHERE id_Evento = $id_Evento";
//    echo $sql;
//    die();

    if ($link->query($sql) === TRUE) {
        //echo '<script> alert ("Usuario dado de baja")</script>';
        header("Location: ../apps-evento-list.php");
    } else {
        echo '<script> alert ("No se pudo dar de baja el evento")</script>';
    }

    // Cerrar la conexión
    $link->close();
}
