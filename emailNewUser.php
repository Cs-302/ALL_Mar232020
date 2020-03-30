<?php

    require 'phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        
        $mail->isSMTP();

        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';
        $mail->Username='xyzrestaurantgroup@gmail.com';
        $mail->Password='H0t1S@uc3';
        
        $mail->setFrom('xyzrestaurantgroup@gmail.com');
        $mail->addAddress($email);
        $mail->addReplyTo('xyzrestaurantgroup@gmail.com');
        
        $mail->isHTML(true);
        $mail->Subject='Account Created';
        $mail->Body='<h1 align=center>Hello '.$username.'<br>Your account has been created</h1>';

    ?> 