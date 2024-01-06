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

$gmailid = 'crowadvancegx@gmail.com'; // YOUR gmail email
$gmailpassword = 'Milonga3841'; // YOUR gmail password
$gmailusername = 'crowadvancegx@gmail.com'; // YOUR gmail User name

?>