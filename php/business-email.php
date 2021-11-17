<?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $useremail = $_POST['email'];
    $business = $_POST['business'];

    $formemail = "GTallent@cascadespares.com";

    echo($firstname . "<br>" . $lastname . "<br>" . $phone . "<br>" . $useremail . "<br>" . $business);


    //login to email

    //send email to self with reply-to the person's email

?>