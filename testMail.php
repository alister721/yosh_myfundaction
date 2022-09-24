<?php 
// Import PHPMailer classes into the global namespace 
require('db.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require ('vendor/autoload.php');
// Create an instance; Pass `true` to enable exceptions 
$mail = new PHPMailer; 
 
// Server settings 
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;     //Enable verbose debug output 
$mail->isSMTP();                             // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;                      // Enable SMTP authentication 
$mail->Username = '25DDT20F1115@PMJ.EDU.MY'; // SMTP username 
$mail->Password = 'tt1234567890000';         // SMTP password 
$mail->SMTPSecure = 'ssl';                   // Enable ssl encryption, `tls` also accepted 
$mail->Port = 465;                           // TCP port to connect to 
 
// Sender info 
$mail->setFrom('calister721@gmail.com','Test'); 
 
// Add a recipient 
$mail->addAddress('calister721@gmail.com','Test'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Email from Localhost'; 
 
// Mail body content 
$bodyContent = '<h1>Test Data</h1>'; 
$bodyContent .= '<p>Please Click Link Below:</p>'; 
$bodyContent .= "<a href='https://www.w3schools.com/howto/howto_js_lightbox.asp'>Test Link</a>"; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    echo 'Message has been sent.'; 
}