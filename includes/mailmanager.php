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
	//$mail->SMTPDebug = 1;

	$mail->setFrom('auctionbay.ucl@gmail.com', 'AuctionBay');
	$mail->addAddress($to);     // Add a recipient
	// $mail->addAddress('ellen@example.com');               // Name is optional
	// $mail->addReplyTo('info@example.com', 'Information');
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(false);                                  // Set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $message;
	// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$mail->send();
}

?>