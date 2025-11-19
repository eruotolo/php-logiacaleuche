<?php
session_start();

require '../layouts/config.php';

if(isset($_POST['actualizar'])) {
    $id_Salida = $_POST['id_Salida'];
    $id_User = $_POST['id_User'];
    $salida_Mes = $_POST['salida_Mes'];
    $salida_Ano = $_POST['salida_Ano'];
    $salida_Motivo = $_POST['salida_Motivo'];
    $salida_MovimientoFecha = $_POST['salida_MovimientoFecha'];
    $salida_Monto = $_POST['salida_Monto'];

    // Convertir formato datetime-local (Y-m-d\TH:i) a formato MySQL (Y-m-d H:i:s)
    $salida_MovimientoFecha = str_replace('T', ' ', $salida_MovimientoFecha) . ':00';

    // ACTUALIZAR SALIDA EN BASE DE DATOS
    $sql = "UPDATE salidadinero SET
            id_User = '$id_User',
            salida_Mes = '$salida_Mes',
            salida_Ano = '$salida_Ano',
            salida_Motivo = '$salida_Motivo',
            salida_Monto = '$salida_Monto',
            salida_MovimientoFecha = '$salida_MovimientoFecha'
            WHERE id_Salida = '$id_Salida'";

    $result = mysqli_query($link, $sql) or ($error= mysqli_error($link));

    if($result) {
        header('Location: ../apps-tesoreria-salida.php');
    } else {
        echo '<script> alert ("NO SE PUDO ACTUALIZAR LA SALIDA: ' . $error . '")</script>';
    }
}else{
    echo '<script> alert ("NO SE RECIBIERON LOS DATOS CORRECTAMENTE")</script>';
}
?>
