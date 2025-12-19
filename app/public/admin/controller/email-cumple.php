<?php

session_start();

include ('../layouts/config.php');

if (isset($_GET['id_User'])){

    $from_Message = $_SESSION['id'];
    $to_Message = $_GET['id_User'];
    $subject_Message = 'Mensaje de Cumpleaños';
    $content_Message = 'Que tengas un muy buen Feliz Cumpleaños!!!';
    $status_Message = 0;

    $sql = "INSERT INTO message (from_Message, to_Message, subject_Message, content_Message, status_Message)
            VALUES ('$from_Message', '$to_Message', '$subject_Message', '$content_Message', '$status_Message')";

//    echo $sql;
//    die();

    $result = mysqli_query($link, $sql);
    //echo '<script> alert ("Actualizado")</script>';

    header('Location: ../index.php');

}else{
    echo '<script> alert ("No se pudo enviar tu saludo de cumpleaños")</script>';
}