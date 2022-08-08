<?php 
die('mail');
$errors = '';
$myemail = 'yogi45vision@gmail.com';
if(empty($_POST['quote_name'])  ||
   empty($_POST['quote_email']) ||
   empty($_POST['quote_subject']))
{
    $errors .= "\n Error: all fields are required";
}
$name = $_POST['quote_name'];
$email_address = $_POST['quote_email'];
$message = $_POST['quote_subject'];
$adid = $_POST['cr_post_id'];
$adname = $_POST['cr_post_name'];
if (!preg_match(
"/ ^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}
if( empty($errors))
{
    $to = '$myemail';
    $email_subject = "Contact form submission: $name";
    $email_body = "You have received a new message. ".
        " Here are the details:\n Interested Buyer's name: $name \n ".
        "Interested Buyer's email: $email_address\n Ad in which Buyer interested: Id->$adid Nmae-> $adname \n  Message \n $message";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    //redirect to the 'thank you' page
    header('Location: contact-form-thank-you.html');
}
?>