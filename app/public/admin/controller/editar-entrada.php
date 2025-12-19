<?php
session_start();

require '../layouts/config.php';

if(isset($_POST['actualizar'])) {
    $id_Entrada = $_POST['id_Entrada'];
    $id_User = $_POST['id_User'];
    $entrada_Mes = $_POST['entrada_Mes'];
    $entrada_Ano = $_POST['entrada_Ano'];
    $entrada_Motivo = $_POST['entrada_Motivo'];
    $entrada_MovimientoFecha = $_POST['entrada_MovimientoFecha'];
    $entrada_Monto = $_POST['entrada_Monto'];

    // Convertir formato datetime-local (Y-m-d\TH:i) a formato MySQL (Y-m-d H:i:s)
    $entrada_MovimientoFecha = str_replace('T', ' ', $entrada_MovimientoFecha) . ':00';

    // ACTUALIZAR ENTRADA EN BASE DE DATOS
    $sql = "UPDATE entradadinero SET
            id_User = '$id_User',
            entrada_Mes = '$entrada_Mes',
            entrada_Ano = '$entrada_Ano',
            entrada_Motivo = '$entrada_Motivo',
            entrada_Monto = '$entrada_Monto',
            entrada_MovimientoFecha = '$entrada_MovimientoFecha'
            WHERE id_Entrada = '$id_Entrada'";

    $result = mysqli_query($link, $sql) or ($error= mysqli_error($link));

    if($result) {
        header('Location: ../apps-tesoreria-entrada.php');
    } else {
        echo '<script> alert ("NO SE PUDO ACTUALIZAR LA ENTRADA: ' . $error . '")</script>';
    }
}else{
    echo '<script> alert ("NO SE RECIBIERON LOS DATOS CORRECTAMENTE")</script>';
}
?>
