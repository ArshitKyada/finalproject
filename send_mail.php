<?php
require 'vendor/autoload.php'; // Adjust the path if you installed PHPMailer manually

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendAuctionWinEmail($to, $productName) {
    $mail = new PHPMailer(true); // Create a new PHPMailer instance

    try {
        // Server settings
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'arshitkyada75@gmail.com'; // SMTP username (Gmail address)
        $mail->Password = 'abmh fape dyjn jizg'; // SMTP password (use an app password if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to (587 for TLS)

        // Recipients
        $mail->setFrom('arshitkyada75@gmail.com', 'Mailer'); // Sender's email and name
        $mail->addAddress($to, 'User'); // Add recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "Congratulations! You've Won the Auction!";
        $mail->Body    = "Dear User,<br><br>Congratulations! You have won the auction for the product: <strong>" . htmlspecialchars($productName) . "</strong>.<br><br>Thank you for participating!<br><br>Best Regards,<br>Your Auction Team";
        $mail->AltBody = "Dear User,\n\nCongratulations! You have won the auction for the product: " . htmlspecialchars($productName) . ".\n\nThank you for participating!\n\nBest Regards,\nYour Auction Team";

        // Send email
        $mail->send();
        echo "<script>alert('Email sent to the user!');</script>"; // Success message
    } catch (Exception $e) {
        echo "<script>alert('Failed to send email. Error: {$mail->ErrorInfo}');</script>"; // Error message
    }
}

?>
