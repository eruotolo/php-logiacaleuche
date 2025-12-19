<?php

require '../layouts/config.php';

// Obtención de los datos del formulario
$name_Trazado = $_POST["name_Trazado"];
$file_name = rand(1000,10000)."-".$_FILES["file_name"]["name"];
$autor_Trazado = $_POST["autor_Trazado"];
$grado_Trazado = $_POST["grado_Trazado"];
$fecha_Trazado = $_POST["fecha_Trazado"];

// Guardar el archivo subido
$target_dir = "../uploads/trazado/";
$target_file = $target_dir . basename($file_name);
move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file);

// Insertar los datos en la tabla "boletin"
$sql = "INSERT INTO trazado (name_Trazado, file_name, autor_Trazado, grado_Trazado, fecha_Trazado)
VALUES ('$name_Trazado', '$file_name', '$autor_Trazado', '$grado_Trazado', '$fecha_Trazado')";

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
