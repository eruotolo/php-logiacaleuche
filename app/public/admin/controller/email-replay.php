<?php

session_start();

include ('../layouts/config.php');

$from_Message = $_SESSION['id'];
$to_Message = $_POST['to_Message'];
$subject_Message = $_POST['subject_Message'];
$content_Message = $_POST['content_Message'];
$status_Message = 0;

$sql = "INSERT INTO message (from_Message, to_Message, subject_Message, content_Message, status_Message)
            VALUES ('$from_Message', '$to_Message', '$subject_Message', '$content_Message', '$status_Message')";

//echo $sql;
//die();

$result = mysqli_query($link, $sql) or ($error= mysqli_error($link));

//echo $error;
//die();

//echo '<script> alert ("Enviado")</script>';
header('Location: ../apps-email-inbox.php');

if ($result === TRUE) {
    //echo "Nuevo registro insertado correctamente.";
    header("Location: ../apps-email-inbox.php");
} else {
    //echo "Error: " . $sql . "<br>" . $link->error;
    header("Location: ../index.php");
}

// Cerrar la conexión
$link->close();