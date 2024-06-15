<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = strip_tags(trim($_POST["contact"]["name"]));
    $email = filter_var(trim($_POST["contact"]["email"]), FILTER_SANITIZE_EMAIL);
    $type = strip_tags(trim($_POST["contact"]["type"]));
    $message = strip_tags(trim($_POST["contact"]["message"]));

    // Validate sanitized input
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address
    $recipient = "office@higlhaglhugl.at"; // TODO: Update to your desired email address

    // Set the email subject
    $subject = "New contact from $name regarding $type";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Type of Inquiry: $type\n\n";
    $email_content .= "Message:\n$message\n";

    // Securely build the email headers to prevent header injection
    $email_headers = "From: " . filter_var($name, FILTER_SANITIZE_EMAIL) . " <no-reply@yourdomain.com>\r\n";
    $email_headers .= "Reply-To: $email";

    // Use a more secure mail sending library or function if available
    // For example, using PHPMailer (not shown here due to complexity)

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        // Set a 500 (internal server error) response code
        http_response_code(500);
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>