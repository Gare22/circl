<?php 
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

    //Code pulled from PHP Mailer readme.md
    try {
        //Server settings
        $mail->SMTPDebug = 2;//Enable verbose debug output
        $mail->isSMTP();//Send using SMTP
        $mail->SMTPAuth = true;//Enable SMTP authentication
        $mail->SMTPSecure = 'tls';//Enable implicit TLS encryption
        $mail->Port = 587;//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Host = 'smtp.gmail.com';//Set the SMTP server to send through

        //Email address and password
        $mail->Username = 'fake@fake.com';//email address you'll be sending from
        $mail->Password = 'fakepassword';//password of above email address
        
    
        //Recipients
        $mail->setFrom('support@circl.com', 'Circl');
        $mail->addAddress('support@circl.com', 'Circl - Support');//Address of where we want to receive our contact forms
        $mail->addReplyTo($email, $business);
        
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        
        /* (Commented out in case we want to use later) - Gare
        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        */

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
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