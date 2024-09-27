<?php
require("PHPMailer/PHPMailer.php");
require("PHPMailer/SMTP.php");
require("PHPMailer/Exception.php");

// Credentials
$username = "genbytesolutionscontact@gmail.com";
$password = "hdjt irou lzbd tzha";

// Form data
$name = $_POST['name'];
$email = $_POST['email'];
$msg_subject = $_POST['msg_subject'];
$budget = $_POST['budget'];
$message = $_POST['message'];

// Config PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP(); // SMTP enabled
$mail->SMTPDebug = 0; // Debug disabled
$mail->SMTPAuth = true; // Auth enabled
$mail->SMTPSecure = 'ssl'; // SSL encryption
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = $username;
$mail->Password = $password;
$mail->SetFrom($email, $name);
$mail->Subject = $msg_subject;
$mail->Body = "Nombre: $name <br>Email: $email <br>Asunto: $msg_subject <br>Presupuesto: $budget <br>Mensaje: $message";
$mail->AddAddress($username);
$mail->addReplyTo($email, $name);

// Send email
if ($mail->Send()) {
    echo "success"; // Happy message
} else {
    echo "error"; // Unhappy message
}
?>
