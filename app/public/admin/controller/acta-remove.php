<?php

require '../layouts/config.php';

// Obtención del identificador único de la fila a eliminar
$id_Acta = $_GET["id_Acta"];

// Eliminar la fila de la tabla "Trazado"
$sql = "DELETE FROM acta WHERE id_Acta = $id_Acta";

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
