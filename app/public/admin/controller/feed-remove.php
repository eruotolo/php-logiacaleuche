<?php

require '../layouts/config.php';

// Obtención del identificador único de la fila a eliminar
$id_Feed = $_GET["id_Feed"];
$estado_Feed = 0;

// Eliminar la fila de la tabla "Trazado"
$sql = "UPDATE feed SET estado_Feed='$estado_Feed' WHERE id_Feed = $id_Feed";

//echo $sql;
//die();

if ($link->query($sql) === TRUE) {
    //echo "Registro eliminado correctamente.";
    header("Location: ../apps-news-list.php");
} else {
    header("Location: ../error-eliminar-archivo.php");
}

// Cerrar la conexión
$link->close();
