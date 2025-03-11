<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the recipient email
    $to = "reservations@taumi.in";
    $subject = "New Booking Inquiry";

    // Sanitize user input
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $mobile = htmlspecialchars(trim($_POST["mobile"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Create email body
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Mobile: $mobile\n";
    $body .= "Message: $message\n";

    // Set email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect to thank-you page or show success message
        header("Location: /thank-you");
        exit;
    } else {
        echo "Failed to send email.";
    }
}
?>
