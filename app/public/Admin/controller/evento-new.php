<?php

session_start();

include ('../layouts/config.php');

if(isset($_POST['crear'])) {
    $id_Evento = $_POST['id_Evento'];
    $nombre_Evento = $_POST['nombre_Evento'];
    $trabajo_Evento = $_POST['trabajo_Evento'];
    $fecha_Evento = $_POST['fecha_Evento'];
    $inicio_Evento = $_POST['inicio_Evento'];
    $fin_Evento = $_POST['fin_Evento'];
    $cat_Evento = $_POST['cat_Evento'];
    $estado_Evento = 1;

    // Insertar los datos en la tabla "Evento"
    $sql = "INSERT INTO evento (nombre_Evento, trabajo_Evento, fecha_Evento, inicio_Evento, fin_Evento, cat_Evento, estado_Evento)
    VALUE ('$nombre_Evento', '$trabajo_Evento', '$fecha_Evento', '$inicio_Evento', '$fin_Evento', '$cat_Evento', '$estado_Evento')";

    //echo $query;
    //die();

    $result = mysqli_query($link, $sql) or ($error= mysqli_error($link));

    //echo $error;
    //die();

    //echo '<script> alert ("Actualizado")</script>';
    header('Location: ../apps-evento-list.php');
}else{
    echo '<script> alert ("No se pudo crear el evento")</script>';
}
?>

