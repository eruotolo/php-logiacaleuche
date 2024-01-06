<?php

require '../layouts/config.php';

// Obtención del identificador único de la fila a eliminar
$id_Libro = $_GET["id_Libro"];

// Eliminar la fila de la tabla "Trazado"
$sql = "DELETE FROM biblioteca WHERE id_Libro = '$id_Libro'";

//echo $sql;
//die();

if ($link->query($sql) === TRUE) {
    //echo "Registro eliminado correctamente.";
    header("Location: ../exito-eliminar-archivo.php");
} else {
    header("Location: ../error-eliminar-archivo.php");
}

// Cerrar la conexión
$link->close();
