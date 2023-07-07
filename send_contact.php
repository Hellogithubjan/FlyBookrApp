<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
include_once 'helpers/helper.php';
require 'helpers/init_conn_db.php';
$fname =  $_POST['fname'];
$email = $_POST['email'];
$message = $_POST['message'];


$email2 = "flybookr@gmail.com";
$subject = "$fname : $email";

if (strlen($fname) > 50) {
    echo 'fname_long';

} elseif (strlen($fname) < 2) {
    echo 'fname_short';

} elseif (strlen($email) > 50) {
    echo 'email_long';

} elseif (strlen($email) < 2) {
    echo 'email_short';

} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo 'eformat';

} elseif (strlen($message) > 500) {
    echo 'message_long';

} elseif (strlen($message) < 3) {
    echo 'message_short';} else {
        //MAILER
    
        require('PHPMailer\PHPMailer-master\src\PHPMailer.php');
        require('PHPMailer\PHPMailer-master\src\Exception.php');
        require('PHPMailer\PHPMailer-master\src\SMTP.php');
    
        $mail = new PHPMailer(true);
       
    
        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'flybookr@gmail.com'; // SMTP username of sender....customer
        $mail->Password = 'nvinjlaeznpmzxmh'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
    
        $mail->setFrom($email);
        $mail->addAddress($email2);
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();
        echo 'true';
    }
    