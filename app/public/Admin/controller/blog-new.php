<?php

session_start();

require '../layouts/config.php';

// Obtención de los datos del formulario
$titulo_Feed = $_POST["titulo_Feed"];
$category_Feed = $_POST["category_Feed"];
$file_name = rand(1000,10000)."-".$_FILES["file_name"]["name"];
$cont_Feed = $_POST["cont_Feed"];
$user_Feed = $_SESSION['id'];
$estado_Feed = 1;

// Guardar el archivo subido
$target_dir = "../uploads/feed/";
$target_file = $target_dir . basename($file_name);
move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file);

// Insertar los datos en la tabla "boletin"
$sql = "INSERT INTO feed (titulo_Feed, category_Feed, file_name,  cont_Feed, user_Feed, estado_Feed)
VALUES ('$titulo_Feed', '$category_Feed', '$file_name', '$cont_Feed', '$user_Feed', '$estado_Feed')";

//echo $sql;
//die();

if ($link->query($sql) === TRUE) {
    //echo "Nuevo registro insertado correctamente.";
    header("Location: ../index.php");
} else {
    //echo "Error: " . $sql . "<br>" . $link->error;
    header("Location: ../error-cargar-archivo.php");
}

// Cerrar la conexión
$link->close();
