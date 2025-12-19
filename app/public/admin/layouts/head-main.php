<?php
// include language configuration file based on selected language
$titulo = 'Intranet Logia Caleuche 250';
$lang = "es";
$id_user = $_SESSION['id'];
date_default_timezone_set('America/Santiago'); // Establece la zona horaria a Santiago de Chile

if (isset($_GET['lang'])) {
   $lang = $_GET['lang'];
   $_SESSION['lang'] = $lang;
}
if( isset( $_SESSION['lang'] ) ) {
    $lang = $_SESSION['lang'];
}else {
    $lang = "es";
}
require_once ("./assets/lang/" . $lang . ".php");

?>

<!DOCTYPE html>
<html lang="<?php echo $lang ?>">