<?php
global $link;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include ('../layouts/config.php');


if(isset($_GET['id_Entrada'])){
    $id_Entrada = $_GET['id_Entrada'];

    // Consulta para obtener los datos del servicio desde la base de datos
    $query = "SELECT * FROM entradadinero EN 
    JOIN users as US ON EN.id_User = US.id 
    JOIN entradamotivo EM ON EN.entrada_Motivo = EM.id_Motivo    
         WHERE id_Entrada = $id_Entrada";

    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    $mesCortado = substr($row['entrada_Mes'], 5);
    $montoFormat = number_format($row['entrada_Monto'], 0, ',', '.');
    $entrada_MovimientoFecha = $row['entrada_MovimientoFecha'];
    $fechaFormateada = date('d-m-Y', strtotime($entrada_MovimientoFecha));

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com';
        $mail->SMTPAuth = true;
        $mail->Username = $gmailusername;
        $mail->Password = $gmailpassword;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipientes
        $mail->setFrom($gmailid, 'Tesoreria R:. L:. Caleuche 250');
        $mail->addAddress($row['useremail'], $row['name'] . ' ' . $row['lastname']);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Boleta de Pago de Cuota Logial';
        $mail->Body = utf8_decode('
            <div style="max-width: 840px; width: 100%; margin: 0 auto; border: 1px solid #000000; box-sizing: border-box;">
                <div style="display: block;">
                    <div style="width: 100%; padding: 20px; box-sizing: border-box; text-align: center;">
                        <img src="https://intranet.logiacaleuche.cl/admin/assets/images/logo.jpg" style="max-width: 160px; width: 100%; height: auto;" alt="Logo">
                    </div>
                    <div style="width: 100%; padding: 0 20px 20px 20px; box-sizing: border-box;">
                        <p style="text-align: right; font-size: 16px; font-weight: 600; margin-top: 1px;margin-bottom: 10px;">Boleta N° ' . $id_Entrada . '</p>
                        <p style="text-align: right; font-size: 18px; font-weight: bold; margin-top: 1px;margin-bottom: 1px;">Respetable Logia Caleuche 250</p>
                        <p style="text-align: right; font-size: 18px; font-weight: bold; margin-top: 1px;margin-bottom: 1px;">Valle de Castro - Chiloé</p>
                    </div>
                </div>
                <div style="width: 100%; padding: 20px; box-sizing: border-box; overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #000000; padding: 10px; font-size: 12px;">Nombre Q:.H:.</th>
                                <th style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">Mes Cuota</th>
                                <th style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">Año</th>
                                <th style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">Motivo</th>
                                <th style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">Fecha de Pago</th>
                                <th style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #000000; padding: 10px; font-size: 12px;">' . $row['name'] . ' ' . $row['lastname'] . '</td>
                                <td style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">'. $mesCortado .'</td>
                                <td style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">' . $row['entrada_Ano'] . '</td>
                                <td style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">' . $row['name_Motivo'] . '</td>
                                <td style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">'. $fechaFormateada .'</td>
                                <td style="border: 1px solid #000000; padding: 10px; text-align: center; font-size: 12px;">$ '. $montoFormat .'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-top: 30px; padding: 0 20px;">
                <p>Le agradecemos por su puntualidad y compromiso con las obligaciones financieras de nuestra Logia.</p>
                <p>Si tiene alguna pregunta o necesita información adicional, no dude en ponerse en contacto con mi persona.</p><br />
                <p>Un Triple Abrazo Fraternal.</p>
                <p>Q:.H:. Tesor. Edgardo Ruotolo Cardozo<br /> Tel: +56 9 6755 3841<br /> Email: edgardoruotolo@gmail.com</p>
            </div>');
        $mail->AltBody = 'No responder a este correo, Muchas gracias.';

        $mail->send();
        //echo 'El mensaje ha sido enviado';
        // redirigir a pagina app-tesoreria-entrada.php
        header("Location: ../apps-tesoreria-entrada.php");

    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
    }
}

// Cerrar la conexión a la base de datos
$link->close();
