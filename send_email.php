<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = strip_tags(trim($_POST["company_name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($company_name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Oops! There was a problem with your submission. Please complete the form and try again.";
        exit;
    }

    $recipient = "marco.rouhana@gmail.com";
    $subject = "New contact from $company_name";

    $email_content = "Company Name: $company_name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $company_name <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }

} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
