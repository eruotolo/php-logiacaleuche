<?php

require '../layouts/config.php';

// Obtención de los datos del formulario
$titulo_Boletin = $_POST["titulo_Boletin"];
$file_name = rand(1000,10000)."-".$_FILES["file_name"]["name"];
$grado_Boletin = $_POST["grado_Boletin"];

// Guardar el archivo subido
$target_dir = "../uploads/boletin/";
$target_file = $target_dir . basename($file_name);
move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file);

// Insertar los datos en la tabla "boletin"
$sql = "INSERT INTO boletin (titulo_Boletin, file_name, grado_Boletin)
VALUES ('$titulo_Boletin', '$file_name', '$grado_Boletin')";

if ($link->query($sql) === TRUE) {
    //echo "Nuevo registro insertado correctamente.";
    header("Location: ../exito-cargar-archivo.php");
} else {
    //echo "Error: " . $sql . "<br>" . $link->error;
    header("Location: ../error-cargar-archivo.php");
}

// Cerrar la conexión
$link->close();
