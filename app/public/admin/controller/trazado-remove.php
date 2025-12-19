<?php

require '../layouts/config.php';

// Obtención del identificador único de la fila a eliminar
$id_Trazado = $_GET["id_Trazado"];

// Eliminar la fila de la tabla "Trazado"
$sql = "DELETE FROM trazado WHERE id_Trazado = '$id_Trazado'";

if ($link->query($sql) === TRUE) {
    //echo "Registro eliminado correctamente.";
    header("Location: ../exito-eliminar-archivo.php");
} else {
    header("Location: ../error-eliminar-archivo.php");
}

// Cerrar la conexión
$link->close();
