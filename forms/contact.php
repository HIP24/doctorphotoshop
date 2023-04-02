<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $to = 'lible1951@teleworm.us';
  $subject = $_POST['subject'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $name <$email>\r\n";
  $headers .= "Content-type: text/plain; charset=utf-8\r\n";
  
  if(mail($to, $subject, $message, $headers)) {
    echo 'success';
  } else {
    echo 'error';
  }
}

?>
