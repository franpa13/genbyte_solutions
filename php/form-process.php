<?php
require("PHPMailer\PHPMailer.php");
require("PHPMailer\SMTP.php");
require("PHPMailer\Exception.php");

// Ruta al archivo .env
$envFile = dirname(__DIR__) . '/.env';

// Leer el archivo .env y obtener las variables
$envVariables = parse_ini_file($envFile);

// Acceder a las variables de entorno
$username = $envVariables['SMTP_USERNAME'];
$password = $envVariables['SMTP_PASSWORD'];

// Datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];
$msg_subject = $_POST['msg_subject'];
$budget = $_POST['budget'];
$message = $_POST['message'];

// Configuración de PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP(); // Habilitar SMTP
$mail->SMTPDebug = 0; // No mostrar debugging
$mail->SMTPAuth = true; // Habilitar autenticación SMTP
$mail->SMTPSecure = 'ssl'; // Habilitar encriptación SSL
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // o 587
$mail->IsHTML(true);
$mail->Username = $username;
$mail->Password = $password;
$mail->SetFrom($email, $name);
$mail->Subject = $msg_subject;
$mail->Body = "Nombre: $name <br>Email: $email <br>Asunto: $msg_subject <br>Presupuesto: $budget <br>Mensaje: $message";
$mail->AddAddress($username);
$mail->addReplyTo($email, $name);

// Enviar correo electrónico y manejar respuesta
if ($mail->Send()) {
    echo "success"; // Éxito en el envío
} else {
    echo "error"; // Error en el envío
}
?>
