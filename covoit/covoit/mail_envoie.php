<?php

    // librairie phpmailer facilite l'envoie de mail et la configuration du smpt

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    require_once "phpmailer/Exception.php";
    require_once "phpmailer/PHPMailer.php";
    require_once "phpmailer/SMTP.php";

    function e_mail($email,$body,$subject)
    {
        $mail = new PHPMailer(true);
        try {
            //  configuration du smtp
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host = "localhost"; // utilisation du serveur de mailhog 
            $mail->Port = 1025;

            //information du mail

            $mail->CharSet = "utf-8";
            $mail->addAddress($email);
            $mail->setFrom("no-reply@lbr.covoiturage.fr","Les briques rouges");
            $mail->Subject = $subject;
            $mail->Body=$body; 

            $mail->send();

            
        } catch (Exception $e) {
            return 0;
        }
        return 1;
    };
?>
