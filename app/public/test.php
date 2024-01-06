<?php

// Define las variables de conexión
$host = "mysql";
$dbname = "db_caleuche";
$user = "eruotolo";
$password = "Guns026772";

// Intenta conectar a la base de datos
$conn = mysqli_connect($host, $user, $password, $dbname);

// Comprueba si la conexión fue exitosa
if ($conn) {
    // La conexión fue exitosa
    echo "Conexión exitosa";
} else {
    // La conexión falló
    echo "Error de conexión: " . mysqli_connect_error();
}

// Cierra la conexión
mysqli_close($conn);

?>