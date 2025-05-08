<!-- <?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
//     $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
//     $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Email details
    // $to = "asmitakarki377@gmail.com"; 
    // $from = "listing377@gmail.com";
    // $subject = "New Contact Form Submission";
    // $headers = "From: $name <$email>" . "\r\n" .
    //            "Reply-To: $email" . "\r\n" .
    //            "Content-Type: text/plain; charset=UTF-8";

    // $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    // Send email
//     if (mail($to, $subject, $body, $headers)) {
//         echo "Message sent successfully!";
//     } else {
//         echo "Failed to send message. Please try again.";
//     }
// }
// ?>

<html>
<head><title>Contact Form</title></head>
<body>
    <form method="post" action="">
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Message: <textarea name="message" rows="5" cols="40" required></textarea><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html> -->

<?php
// Show all errors (for debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'poudelaswin942@gmail.com';             // Your Gmail address
        $mail->Password   = 'bphj dnoo bfea brcq';               // Use app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           // Enable implicit TLS encryption
        $mail->Port       = 465;                                    // TCP port

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('poudelaswin942@gmail.com', 'Receiver');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Form';
        $mail->Body    = 'You have received a new message from <strong>' . htmlspecialchars($name) . '</strong><br><br>' .
                         'Email: ' . htmlspecialchars($email) . '<br><br>' .
                         'Message:<br>' . nl2br(htmlspecialchars($message));

        $mail->send();
        echo '<p style="color:green;">Message has been sent successfully!</p>';
    } catch (Exception $e) {
        echo '<p style="color:red;">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</p>';
    }
}
?>

<!-- HTML Form (for testing in browser) -->
<?php if ($_SERVER['REQUEST_METHOD'] != 'POST') { ?>
    <h2>Send a Test Email</h2>
    <form method="post" action="">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Message:</label><br>
        <textarea name="message" rows="5" required></textarea><br><br>

        <button type="submit">Send Email</button>
    </form>
<?php } ?>