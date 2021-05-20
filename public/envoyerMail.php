<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
      
        require '../PHPMailer-master/src/Exception.php';
        require '../PHPMailer-master/src/PHPMailer.php';
        require '../PHPMailer-master/src/SMTP.php';

        function envoyerMail($strDestinataire, $strSujet, $strContenu){
            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'macandcheeseprojetweb@gmail.com';
            $mail->Password = 'QwEr!2#4'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('macandcheeseprojetweb@gmail.com', 'LesPetiteAnnoncesGG');
            $mail->addReplyTo('macandcheeseprojetweb@gmail.com', 'LesPetiteAnnoncesGG');
            $mail->addAddress($strDestinataire, 'Users');
            $mail->Subject = $strSujet;
            $mailContent = $strContenu;
            $mail->Body = $mailContent;
            $mail->send();
        }
?>