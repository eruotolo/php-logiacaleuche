<?php

require '../layouts/config.php';

// Obtención de los datos del formulario
$nombre_Libro = $_POST["nombre_Libro"];
$file_name = rand(1000,10000)."-".$_FILES["file_name"]["name"];
$autor_Libro = $_POST["autor_Libro"];
$grado_Libro = $_POST["grado_Libro"];

// Guardar el archivo subido
$target_dir = "../uploads/biblioteca/";
$target_file = $target_dir . basename($file_name);
move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file);

// Insertar los datos en la tabla "biblioteca"
$sql = "INSERT INTO biblioteca (nombre_Libro, autor_Libro, file_name, grado_Libro)
VALUES ('$nombre_Libro', '$autor_Libro', '$file_name', '$grado_Libro')";

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

