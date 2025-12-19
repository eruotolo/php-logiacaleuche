<?php

session_start();

include ('../layouts/config.php');

if (isset($_POST['update'])) {
    //Creo las Variables
    $id = $_POST['id'];
    $password = $_POST['password'];
    $confirm_password = "";
    $hash = password_hash($password, PASSWORD_DEFAULT);


    $query = "UPDATE users SET password='$hash' WHERE id = $id";

    //echo $query;
    //die();
    $result = mysqli_query($link, $query);
    //echo '<script> alert ("Actualizado")</script>';

    header('Location: ../apps-contacts-profile.php');
}else{
    echo '<script> alert ("No se pudo actualizar el password")</script>';
}
