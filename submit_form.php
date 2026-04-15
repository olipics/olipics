<<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = htmlspecialchars(trim($_POST["name"] ?? ""));
    $email   = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    if (empty($name) || empty($email) || empty($message)) {
        die("⚠️ Kérlek töltsd ki az összes mezőt!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("⚠️ Hibás email cím!");
    }
    $mail = new PHPMailer(true);
    try {
        // SMTP beállítások
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // pl. Gmail
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sajatemail@gmail.com'; // IDE a saját email
        $mail->Password   = 'app-jelszo'; // Gmail app password kell
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        // Feladó / címzett
        $mail->setFrom($email, $name);
        $mail->addAddress('howeidiadel@gmail.com', 'Adel');
        // Tartalom
        $mail->isHTML(false);
        $mail->Subject = "Új üzenet a CyberLaw weboldalról";
        $mail->Body    = "Név: $name\nEmail: $email\n\nÜzenet:\n$message";

        $mail->send();
        echo "<h2>✅ Köszönjük! Az üzenetedet elküldtük.</h2>";
    } catch (Exception $e) {
        echo "<h2>❌ Hiba történt: {$mail->ErrorInfo}</h2>";
    }
} else {
    die("Hibás kérés.");
}