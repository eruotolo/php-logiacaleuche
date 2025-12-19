<?php

session_start();

include ('../layouts/config.php');

$user_Comment = $_SESSION['id'];
$feed_Comment = $_POST['feed_Comment'];
$message_Comment = $_POST['message_Comment'];

$sql = "INSERT INTO commentsfeed (user_Comment, feed_Comment, message_Comment)
            VALUES ('$user_Comment', '$feed_Comment', '$message_Comment')";

//echo $sql;
//die();
$url = "../apps-blog-detail.php?id_Feed=$feed_Comment";
//echo $url;
//die();

$result = mysqli_query($link, $sql) or ($error= mysqli_error($link));

//echo '<script> alert ("Enviado")</script>';
header("Location: $url");

if ($result === TRUE) {
    //echo "Nuevo registro insertado correctamente.";
    header("Location: $url");
} else {
    //echo "Error: " . $sql . "<br>" . $link->error;
    header('Location: ../index.php');
}

// Cerrar la conexión
$link->close();