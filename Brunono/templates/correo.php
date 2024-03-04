<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera la información del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $correo = $_SESSION['correo'];
    $correoDestino = 'destinatario@example.com'; // Reemplaza con el correo del destinatario

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_correo@example.com';
        $mail->Password = 'tu_contraseña';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Contenido del correo electrónico
        $mail->setFrom('tu_correo@example.com', 'Tu Nombre');
        $mail->addAddress($correoDestino);
        $mail->isHTML(true);
        $mail->Subject = 'Información del juguete';
        $mail->Body = "Nombre del juguete: $nombre<br>Precio: $precio";

        // Envío del correo electrónico
        $mail->send();
        echo 'El correo ha sido enviado';
    } catch (Exception $e) {
        echo 'Hubo un error al enviar el correo: ', $mail->ErrorInfo;
    }
}
?>
