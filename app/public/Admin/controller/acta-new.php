<?php

require '../layouts/config.php';

// Obtención de los datos del formulario
$name_Acta = $_POST["name_Acta"];
$file_name = rand(1000,10000)."-".$_FILES["file_name"]["name"];
$grado_Acta = $_POST["grado_Acta"];
$fecha_Acta = $_POST["fecha_Acta"];

// Guardar el archivo subido
$target_dir = "../uploads/acta/";
$target_file = $target_dir . basename($file_name);
move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file);

// Insertar los datos en la tabla "boletin"
$sql = "INSERT INTO acta (name_Acta, file_name, grado_Acta, fecha_Acta)
VALUES ('$name_Acta', '$file_name', '$grado_Acta', '$fecha_Acta')";

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
