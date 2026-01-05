<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

/*---------------- INSTRUCCIONES --------------*/
// 1. Copiar este archivo como config.php
// 2. Cambiar los valores con tus credenciales reales
// 3. NO subir config.php al repositorio (está en .gitignore)

/*---------------- SERVER DOCKER LOCAL --------------*/
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'caleuche');

/*---------------- SERVER PRODUCCIÓN --------------*/
// Descomentar y configurar para producción
/*
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'tu_usuario_db');
define('DB_PASSWORD', 'tu_password_db');
define('DB_NAME', 'tu_nombre_db');
*/

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Configuración de email
$gmailid = 'tu_email@example.com'; // YOUR email
$gmailpassword = 'tu_password_smtp'; // YOUR SMTP password
$gmailusername = 'tu_usuario@gmail.com'; // YOUR email username

// Configuración SMTP Centralizada
$smtp_host = 'smtp-relay.brevo.com';
$smtp_port = 587;
$smtp_secure = 'tls';
$smtp_username = $gmailusername;
$smtp_password = $gmailpassword;
$smtp_from_email = $gmailid;
$smtp_from_name = 'Tesoreria R:. L:. Caleuche 250';

?>

