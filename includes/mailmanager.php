<?php
require 'PHPMailer/PHPMailerAutoload.php';

function sendMail($to, $subject,$message){

	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'auctionbay.ucl@gmail.com';         // SMTP username
	$mail->Password = 'gc06coursework';                   // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to
	$mail->setFrom('auctionbay.ucl@gmail.com', 'AuctionBay');
	$mail->addAddress($to);     // Add a recipient
	$mail->isHTML(false);                                  // Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body    = $message;
	$mail->send();
}

?>