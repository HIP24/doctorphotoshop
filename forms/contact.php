<?php

ini_set("SMTP", "mail.example.com");
ini_set("smtp_port", "25");


// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
  http_response_code(400);
  echo "Please fill out all required fields.";
  exit;
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Create email body
$body = "Name: $name\nEmail: $email\n\nSubject: $subject\n\nMessage:\n$message";

// Set up email headers
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
$to = "lible1951@teleworm.us"; // Replace with your own email address
if(mail($to, $subject, $body, $headers)) {
  http_response_code(200);
  echo "Thank you! Your message has been sent.";
} else {
  http_response_code(500);
  echo "Oops! Something went wrong and we couldn't send your message.";
}
?>
