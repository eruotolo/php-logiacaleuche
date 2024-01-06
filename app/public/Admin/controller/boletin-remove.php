<?php

require '../layouts/config.php';

// Obtención del identificador único de la fila a eliminar
$id_Boletin = $_GET["id_Boletin"];

// Eliminar la fila de la tabla "boletin"
$sql = "DELETE FROM boletin WHERE id_Boletin = '$id_Boletin'";

if ($link->query($sql) === TRUE) {
    //echo "Registro eliminado correctamente.";
    header("Location: ../exito-eliminar-archivo.php");
} else {
    header("Location: ../error-eliminar-archivo.php");
}

// Cerrar la conexión
$link->close();
