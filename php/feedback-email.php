<?php
//feedback-email.php
//description: Obtains contact us form information via post HTTP method then sends 
//     email with PHPMailer (https://github.com/PHPMailer/PHPMailer) via gmail account to Dawson

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
    $message = $_POST['message'];

    //Code copied from PHP Mailer readme.md
    try {
        //Server settings
        $mail->SMTPDebug = 2;//Enable verbose debug output
        $mail->isSMTP();//Send using SMTP
        $mail->SMTPAuth = true;//Enable SMTP authentication
        $mail->SMTPSecure = 'tls';//Enable implicit TLS encryption
        $mail->Port = 587;//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Host = 'smtp.gmail.com';//Set the SMTP server to send through

        //Email address and password
        $mail->Username = 'Fake@gmail.com';//email address you'll be sending from
        $mail->Password = 'Fake';//password of above email address
        
    
        //Recipients
        $mail->setFrom('Fake@gmail.com', 'Circl');
        $mail->addAddress('Fake@Fake.com', 'Fake');//Address of where we want to receive our contact forms
        $mail->addReplyTo($email, $first_name);
        
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        
        /* (Commented out in case we want to use later) - Gare
        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        */

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = '' . $first_name . ' ' . $last_name . ' has feedback for us.';
        $mail->Body    = '<b>' . $first_name . ' ' . $last_name . '</b> has given us feedback. <br>Contact them at ' . $email . ' or phone number ' . $phone . '.<br> Their feedback says: <br><b>' . $message . '</b>';
        $mail->AltBody = $first_name . ' ' . $last_name . ' has given us feedback. Contact them at ' . $email . ' or phone number ' . $phone . '. Their feedback says: ' . $message;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
?>