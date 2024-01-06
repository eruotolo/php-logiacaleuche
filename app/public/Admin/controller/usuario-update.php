<?php

session_start();

include ('../layouts/config.php');

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $oficialidad = $_POST['oficialidad'];
    $grado = $_POST['grado'];

    if(isset($_FILES['file']) && $_FILES["file"]["error"] == 0){
        #file name with a random number so that similar dont get replaced
        $pname = rand(1000, 10000) . "-" . $_FILES["file"]["name"];

        #temporary file name to store file
        $tname = $_FILES["file"]["tmp_name"];

        #upload directory path
        $uploads_dir = '../uploads/usuarios/';

        #TO move the uploaded file to specific location
        move_uploaded_file($tname, $uploads_dir . '/' . $pname);

        $image_update = ",image='$pname'";
    }

    // Name
    if (isset($_POST['name']) && $_POST['name'] <> '') {
        $name_update = "name='{$_POST['name']}'";
    } else {
        $name_update = "name=NULL";
    }
    // Lastname
    if (isset($_POST['lastname']) && $_POST['lastname'] <> '') {
        $lastname_update = ",lastname='{$_POST['lastname']}'";
    } else {
        $lastname_update = ",lastname=NULL";
    }
    // Useremail
    if (isset($_POST['useremail']) && $_POST['useremail'] <> '') {
        $useremail_update = ",useremail='{$_POST['useremail']}'";
    } else {
        $useremail_update = ",useremail=NULL";
    }
    // Phone
    if (isset($_POST['phone']) && $_POST['phone'] <> '') {
        $phone_update = ",phone='{$_POST['phone']}'";
    } else {
        $phone_update = ",phone=NULL";
    }
    // City
    if (isset($_POST['city']) && $_POST['city'] <> '') {
        $city_update = ",city='{$_POST['city']}'";
    } else {
        $city_update = ",city=NULL";
    }
    // Addresss
    if (isset($_POST['address']) && $_POST['address'] <> '') {
        $address_update = ",address='{$_POST['address']}'";
    } else {
        $address_update = ",address=NULL";
    }

    if (isset($_POST['date_birthday']) && $_POST['date_birthday'] <> '') {
        $date_birthday_update = ",date_birthday='{$_POST['date_birthday']}'";
    } else {
        $date_birthday_update = ",date_birthday=NULL";
    }

    if (isset($_POST['date_initiation']) && $_POST['date_initiation'] <> '') {
        $date_initiation_update = ",date_initiation='{$_POST['date_initiation']}'";
    } else {
        $date_initiation_update = ",date_initiation=NULL";
    }

    if (isset($_POST['date_salary']) && $_POST['date_salary'] <> '') {
        $date_salary_update = ",date_salary='{$_POST['date_salary']}'";
    } else {
        $date_salary_update = ",date_salary=NULL";
    }

    if (isset($_POST['date_exalted']) && $_POST['date_exalted'] <> '') {
        $date_exalted_update = ",date_exalted='{$_POST['date_exalted']}'";
    } else {
        $date_exalted_update = ",date_exalted=NULL";
    }

    $query = "UPDATE users SET {$name_update} {$lastname_update}{$useremail_update} ,oficialidad='$oficialidad', grado='$grado'{$phone_update} {$city_update} {$address_update} {$date_birthday_update} {$date_initiation_update} {$date_salary_update} {$date_exalted_update} {$image_update} WHERE id = $id";

    //echo $query;
    //die();

    $result = mysqli_query($link, $query) or ($error= mysqli_error($link));

    //echo $error;
    //die();

    //echo '<script> alert ("Actualizado")</script>';
    header('Location: ../apps-contacts-list.php');
}else{
    echo '<script> alert ("No se pudo actualizar el password")</script>';
}
?>