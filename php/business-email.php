<?php 

if(isset($_POST['submit'])){

    $mailserver = '{imap-mail.outlook.com:993/ssl/novalidate-cert}';
    $to = "example@email.com"; // this is your Email address
    $password = "password";
    
    
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    echo "<script>console.log('".$first_name."');</script>"; //debug console log
    
    $subject = "Form submission";//Subject line
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['business']; //actual message

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    }
?>