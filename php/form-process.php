<?php
require("PHPMailer\PHPMailer.php");
require("PHPMailer\SMTP.php");
require("PHPMailer\Exception.php");

// Datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];
$msg_subject = $_POST['msg_subject'];
$budget = $_POST['budget'];
$message = $_POST['message'];

// Configuración de PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP(); // Habilitar SMTP
$mail->SMTPDebug = 1; // No mostrar debugging
$mail->SMTPAuth = true; // Habilitar autenticación SMTP
$mail->SMTPSecure = 'ssl'; // Habilitar encriptación SSL
$mail->Host = "smtp.titan.email";
$mail->Port = 465; // o 587
$mail->IsHTML(true);
$mail->Username = "";
$mail->Password = "";
$mail->SetFrom($email, $name);
$mail->Subject = $msg_subject;
$mail->Body = "Nombre: $name <br>Email: $email <br>Asunto: $msg_subject <br>Presupuesto: $budget <br>Mensaje: $message";
$mail->AddAddress("");
$mail->addReplyTo($email, $name);

// Enviar correo electrónico y manejar respuesta
if ($mail->Send()) {
    echo "success"; // Éxito en el envío
} else {
    echo "error"; // Error en el envío
}
?>
