<?php
session_start();

require '../layouts/config.php';

if(isset($_POST['crear'])) {
    $id_User = $_POST['id_User'];
    $entrada_Mes = $_POST['entrada_Mes'];
    $entrada_Ano = $_POST['entrada_Ano'];
    $entrada_Motivo = $_POST['entrada_Motivo'];
    $entrada_MovimientoFecha = $_POST['entrada_MovimientoFecha'];
    $entrada_Monto = $_POST['entrada_Monto'];

    // GUARDAR ENTRADA EN BASE DE DATOS
        $sql = "INSERT INTO entradadinero (id_User, entrada_Mes, entrada_Ano,entrada_Motivo, entrada_Monto, entrada_MovimientoFecha ) 
            VALUE ('$id_User', '$entrada_Mes', '$entrada_Ano','$entrada_Motivo', '$entrada_Monto', '$entrada_MovimientoFecha')";

    //echo $query;
    //die();

    $result = mysqli_query($link, $sql) or ($error= mysqli_error($link));

    //echo $error;
    //die();

    //echo '<script> alert ("Actualizado")</script>';
    header('Location: ../apps-tesoreria-entrada.php');
}else{
    echo '<script> alert ("NO SE PUDO REGISTRAR LA ENTRADA")</script>';
}
?>

