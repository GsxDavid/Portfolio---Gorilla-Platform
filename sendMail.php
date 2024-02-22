<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$action = isset($_POST["action"]) ? $_POST["action"] : null;
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
$apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : null;
$email = isset($_POST["email"]) ? $_POST["email"] : null;
$mensaje = isset($_POST["mensaje"]) ? $_POST["mensaje"] : null;

if($action === "sendMessage") {
  echo json_encode(sendMessage($mail, $nombre, $apellidos, $email, $mensaje));
}

function sendMessage($mail, $nombre, $apellidos, $email, $mensaje) {
  try {
    // Configuración del servidor
    /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "david.mancerarm@gmail.com";
    $mail->Password = "tlhyvzjazzotzqgy";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Destinatarios
    $mail->setFrom("david.mancerarm@gmail.com", "Gorilla Platform");
    $mail->addAddress($email, $nombre);

    // Content
    $mail->isHTML(true);
    $mail->Subject ="Su comentario ha sido recibido correctamente";
    $mail->Body = '<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmación de Recepción de Tu Información</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding: 20px; text-align: center; background-color: #0077b6;">
      <h1 style="color: #ffffff;">Confirmación de Recepción</h1>
    </td>
  </tr>
</table>

<table width="600" cellpadding="20" cellspacing="0" border="0" align="center" style="background-color: #ffffff;">
  <tr>
    <td>
      <p>Estimado ' . $nombre. ' ' . $apellidos .',</p>
      <p>Espero que te encuentres bien. Queremos informarte que hemos recibido con éxito la información que nos proporcionaste. Apreciamos mucho tu interés en nuestros servicios y estamos emocionados de tener la oportunidad de trabajar contigo.</p>
      <p>Un miembro de nuestro equipo se pondrá en contacto contigo en breve para discutir más a fondo tus necesidades y brindarte la atención personalizada que mereces. Estamos comprometidos en proporcionarte la mejor solución posible y asegurarnos de que tu experiencia con nosotros sea excepcional.</p>
      <p>Si tienes alguna pregunta adicional o algún detalle que quieras compartir antes de nuestra llamada, no dudes en responder a este correo electrónico. Estamos aquí para ayudarte en todo momento.</p>
      <p>Agradecemos tu confianza en nosotros y estamos ansiosos por comenzar a trabajar en tu proyecto. Mantente atento a nuestro próximo contacto.</p>
      <p>Gracias y saludos cordiales,</p>
      <p>Gorilla Platform<br>+57 3125859980<br>support@gorilla-platform.com<br>www.gorilla-platform.com</p>
    </td>
  </tr>
</table>

</body>
</html>';

    $mail->send();
    return array("status" =>"Message has been send");
  }
  catch (Exception $exception) {
    return array("status" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
  }
}