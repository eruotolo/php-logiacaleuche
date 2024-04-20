<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
/*---------------- SERVER DOCKER LOCAL --------------*/

define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'caleuche');

/*---------------- SERVER PRODUCCIÓN --------------*/
/*
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'uyg1o9ehfwnzx');
define('DB_PASSWORD', 'Guns026772');
define('DB_NAME', 'dbeaag3s1tjjr4');
*/

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$gmailid = 'tesoreria@logiacaleuche.cl'; // YOUR gmail email
$gmailpassword = 'xsmtpsib-03055b179850b8a8bf7f6bc3985403fc2bb7f1e786167d129521ad2c6d3ad902-GVqxrFzbg93ywmsc'; // YOUR gmail password
$gmailusername = 'edgardoruotolo@gmail.com'; // YOUR gmail User name

?>