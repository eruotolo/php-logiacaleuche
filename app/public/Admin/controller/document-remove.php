<?php

require '../layouts/config.php';

// Obtención del identificador único de la fila a eliminar
$id_Doc = $_GET["id_Doc"];

// Eliminar la fila de la tabla "boletin"
$sql = "DELETE FROM documents WHERE id_Doc = '$id_Doc'";

if ($link->query($sql) === TRUE) {
    //echo "Registro eliminado correctamente.";
    header("Location: ../exito-eliminar-archivo.php");
} else {
    header("Location: ../error-eliminar-archivo.php");
}

// Cerrar la conexión
$link->close();