<?php
// Conexión a la base de datos
require '../layouts/config.php';

// Obtener el ID de la noticia a eliminar
$id_noticia = $_GET['id'];

// Eliminar la noticia de la base de datos
$sql = "DELETE FROM noticias WHERE id_Noticia = '$id_noticia'";
$resultado = mysqli_query($link, $sql);

// Mostrar mensaje de éxito o error
if ($resultado) {
    //echo "La noticia se eliminó correctamente.";
    header("location: ../apps-news-list.php");
} else {
    echo "Error al eliminar la noticia: " . mysqli_error($link);
}

// Cerrar la conexión a la base de datos
mysqli_close($link);
?>
