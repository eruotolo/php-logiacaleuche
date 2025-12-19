<?php

require '../layouts/config.php';

// Obtención de los datos del formulario
$name_Doc = $_POST["name_Doc"];
$file_name = rand(1000,10000)."-".$_FILES["file_name"]["name"];
$date_Doc = $_POST["date_Doc"];


// Guardar el archivo subido
$target_dir = "../uploads/documents/";
$target_file = $target_dir . basename($file_name);
move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file);

// Insertar los datos en la tabla "boletin"
$sql = "INSERT INTO documents (name_Doc, file_name, date_Doc)
VALUES ('$name_Doc', '$file_name', '$date_Doc')";

//echo $sql;
//die();

if ($link->query($sql) === TRUE) {
    //echo "Nuevo registro insertado correctamente.";
    header("Location: ../exito-cargar-archivo.php");
} else {
    //echo "Error: " . $sql . "<br>" . $link->error;
    header("Location: ../error-cargar-archivo.php");
}

// Cerrar la conexión
$link->close();

