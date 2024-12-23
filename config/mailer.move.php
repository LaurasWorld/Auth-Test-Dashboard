<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

function sendActivationMail($email, $activationLink)
{
  $mail = new PHPMailer(true);

  try {
    // Server-Einstellungen
    $mail->isSMTP();
    $mail->Host = 'smtp-host';
    $mail->SMTPAuth = true;
    $mail->Username = 'smtp-username';
    $mail->Password = 'smtp-password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Empfänger
    $mail->setFrom('sender-emailadress', 'Send From Panel');
    $mail->addAddress($email);

    // Inhalt
    $mail->isHTML(true);
    $mail->Subject = 'Aktiviere deinen Account';
    $mail->Body = "Klicke auf diesen Link, um deinen Account zu aktivieren: <a href=\"$activationLink\">Aktivieren</a>";

    $mail->send();
  } catch (Exception $e) {
    error_log("Mail konnte nicht gesendet werden. Fehler: {$mail->ErrorInfo}");
  }
}
