<?php 
//business-email.php
//description: Obtains business email form information via post HTTP method then sends 
//     email with PHPMailer (https://github.com/PHPMailer/PHPMailer) via gmail account to Dawson
//author: Garrett Tallent (https://github.com/gare22)

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if(isset($_POST['submit'])){
    
    //All POST variabls
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $business = $_POST['business'];

    //Code pulled from PHP Mailer readme.md (https://github.com/PHPMailer/PHPMailer)
    try {
        //Server settings
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Host = 'smtp.gmail.com';

        //Email address and password
        $mail->Username = 'fake@fake.com';
        $mail->Password = 'fakepassword';
        
    
        //Recipients
        $mail->setFrom('support@circl.com', 'Circl');
        $mail->addAddress('support@circl.com', 'Circl - Support');//Address of where we want to receive our contact forms
        $mail->addReplyTo($email, $business);
        

        //Content
        $mail->isHTML(true);//Set email format to HTML
        $mail->Subject = $business . ' would like to sign up';
        $mail->Body    = '<b>' . $business . '</b> would like to sign up. <br>Contact them through ' . $first_name .' '. $last_name .' at ' . $email . ' or phone number ' . $phone . '.';
        $mail->AltBody = $business . ' would like to sign up. Contact them through ' . $first_name .' '. $last_name .' at ' . $email . ' or phone number ' . $phone . '.';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
?>