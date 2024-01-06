<?php
session_start();

require '../layouts/config.php';

if(isset($_POST['crear'])) {
    $id_User = $_POST['id_User'];
    $salida_Mes = $_POST['salida_Mes'];
    $salida_Ano = $_POST['salida_Ano'];
    $salida_Motivo = $_POST['salida_Motivo'];
    $salida_Monto = $_POST['salida_Monto'];
    $salida_MovimientoFecha = $_POST['salida_MovimientoFecha'];

    // GUARDAR ENTRADA EN BASE DE DATOS
    $sql = "INSERT INTO salidadinero (id_User, salida_Mes, salida_Ano,salida_Motivo, salida_Monto, salida_MovimientoFecha ) 
            VALUES ('$id_User', '$salida_Mes', '$salida_Ano','$salida_Motivo', '$salida_Monto', '$salida_MovimientoFecha')";

    //echo $sql;
    //die();

    $result = mysqli_query($link, $sql) or ($error= mysqli_error($link));

    //echo $error;
    //die();
    //echo '<script> alert ("Actualizado")</script>';
    header('Location: ../apps-tesoreria-salida.php');
}else{
    echo '<script> alert ("NO SE PUDO REGISTRAR LA ENTRADA")</script>';
}
?>