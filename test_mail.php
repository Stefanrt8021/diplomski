<?php

// Uključi PHPMailer fajlove
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

// Koristi PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    // Konfiguracija SMTP-a
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io'; // Mailtrap server
    $mail->SMTPAuth = true;
    $mail->Username = 'bd4f084dffe888'; // Tvoje Mailtrap korisničko ime
    $mail->Password = '723bdcdc9ddb98'; // Tvoja Mailtrap lozinka
    $mail->Port = 2525;

    // Konfiguracija mejla
    $mail->setFrom('noreply@mojsajt.com', 'Moj Sajt');
    $mail->addAddress('tvojemail@example.com'); // Tvoj mejl za testiranje

    // Sadržaj mejla
    $mail->isHTML(true);
    $mail->Subject = 'Test mejl';
    $mail->Body    = 'Ovo je test mejl poslat putem PHPMailer-a.';

    // Šaljemo mejl
    $mail->send();
    echo 'Mejl je uspešno poslat!';
} catch (Exception $e) {
    echo "Greška u slanju mejla: {$mail->ErrorInfo}";
}

?>
