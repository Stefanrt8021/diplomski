<?php 

require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendActivationMail($toEmail, $activationCode){
    $mail = new PHPMailer(true);
    try {
        // Mailtrap konfiguracija
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'bd4f084dffe888'; // zameni!
        $mail->Password = '723bdcdc9ddb98'; // zameni!
        $mail->Port = 2525;

        // Email podaci
        $mail->setFrom('noreply@mojsajt.com', 'Moj Sajt');
        $mail->addAddress($toEmail);

        $activationLink = "http://localhost/diplomski/activate.php?code=$activationCode&activated=true";
        $mail->isHTML(true);
        $mail->Subject = 'Aktiviraj svoj nalog';
        $mail->Body = "Klikni na link da aktiviraš svoj nalog: <a href='$activationLink'>$activationLink</a>";

        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log("Greška u slanju mejla: {$mail->ErrorInfo}");
        return false;
    }
}


