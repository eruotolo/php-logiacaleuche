<?php
session_start();

include ('../layouts/config.php');

if (isset($_POST['update'])) {
    //Creo las Variables
    $id = $_POST['id'];
    $useremail = $_POST['useremail'];
    $username = $_POST['username'];
    $firstname = $_POST['name'];
    $lastname = $_POST['lastname'];
    $date_birthday = $_POST['date_birthday'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    if(isset($_FILES['file']) && $_FILES["file"]["error"] == 0){
        #file name with a random number so that similar dont get replaced
        $pname = rand(1000, 10000) . "-" . $_FILES["file"]["name"];

        #temporary file name to store file
        $tname = $_FILES["file"]["tmp_name"];

        #upload directory path
        $uploads_dir = '../uploads/usuarios/';

        #TO move the uploaded file to specific location
        move_uploaded_file($tname, $uploads_dir . '/' . $pname);

        //Query update con Imagen
        $query = "UPDATE users SET useremail='$useremail', username='$username', image='$pname', name='$firstname', lastname='$lastname', date_birthday='$date_birthday', phone='$phone', address='$address', city='$city'
        WHERE id = $id";

        $result = mysqli_query($link, $query);
        $_SESSION['image'] = $pname;

    }else{
        //Query update sin Imagen
        $query = "UPDATE users SET useremail='$useremail', username='$username', name='$firstname', lastname='$lastname', date_birthday='$date_birthday', phone='$phone', address='$address', city='$city'
        WHERE id = $id";
    }

    //echo $query;
    //die();
    $result = mysqli_query($link, $query);

    //Update Variables SESSION
    $_SESSION['useremail'] = $useremail;
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['date_birthday'] = $date_birthday;
    $_SESSION['phone'] = $phone;
    $_SESSION['address'] = $address;
    $_SESSION['city'] = $city;


    echo '<script> alert ("Actualizado")</script>';

    header('Location: ../apps-contacts-profile.php');
}else{
    echo '<script> alert ("No Actualizado")</script>';
}

