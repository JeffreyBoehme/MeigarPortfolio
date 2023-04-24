<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["your-name"];
    $surname = $_POST["your-surname"];
    $email = $_POST["your-email"];
    $subject = $_POST["your-subject"];
    $message = $_POST["your-message"];

    // Perform basic input validation
    if (empty($name) || empty($surname) || empty($email) || empty($subject) || empty($message)) {
        header("Location: index.html?error=emptyfields");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?error=invalidemail");
        exit();
    } else {
        // Prepare email
        $to = "jeffrey.boehme2@gmail.com";
        $email_subject = "Contact Form: " . $subject;
        $email_body = "Name: " . $name . "\nSurname: " . $surname . "\nEmail: " . $email . "\n\nMessage:\n" . $message;
        $headers = "From: " . $email . "\r\nReply-To: " . $email . "\r\n";

        // Send email
        if (mail($to, $email_subject, $email_body, $headers)) {
            header("Location: index.html?success=1");
        } else {
            header("Location: index.html?error=sendfailed");
        }
    }
} else {
    // Redirect to the homepage if the form was not submitted
    header("Location: index.html");
    exit();
}