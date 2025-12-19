<?php
require '../layouts/config.php';

// Obtener los datos del formulario
$titulo_Noticia = $_POST['titulo_Noticia'];
$img_Noticia = rand(1000,10000)."-".$_FILES['img_Noticia']['name'];
$imagen_temp = $_FILES['img_Noticia']['tmp_name'];
$ext_Noticia = $_POST['ext_Noticia'];
$id_Categoria = $_POST['id_Categoria'];
$id_User = $_POST['id_User'];
$des_Noticia = $_POST['des_Noticia'];
$gallery = $_FILES['gallery'];

// Guardar la imagen principal
$imagen_ruta = "../uploads/noticias/" . $img_Noticia;
move_uploaded_file($imagen_temp, $imagen_ruta);

// Guardar la noticia en la base de datos
$sql = "INSERT INTO noticias (titulo_Noticia, img_Noticia, ext_Noticia, id_Categoria, id_User, des_Noticia, gallery) 
                    VALUES ('$titulo_Noticia', '$imagen_ruta', '$ext_Noticia', '$id_Categoria', '$id_User', '$des_Noticia', '')";

if (mysqli_query($link, $sql)) {
    $id_noticia = mysqli_insert_id($link);

    // Guardar las imágenes de la galería
    if (!empty($gallery['name'][0])) {
        $galeria_ruta = "../uploads/noticias/";
        foreach ($gallery['name'] as $key => $nombre) {
            $temp = $gallery['tmp_name'][$key];
            $ruta = $galeria_ruta . $nombre;
            move_uploaded_file($temp, $ruta);
            $sql = "UPDATE Noticias SET gallery = CONCAT(gallery, '$ruta,') WHERE id_Noticia = '$id_noticia'";
            mysqli_query($link, $sql);
        }
    }

    // Redirigir a la página de éxito
    header("Location: ../apps-news-list.php");
} else {
    echo "Error al guardar la noticia: " . mysqli_error($link);
}

// Cerrar la conexión a la base de datos
mysqli_close($link);
?>