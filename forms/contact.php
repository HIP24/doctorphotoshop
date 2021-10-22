<?php

if($_POST) {
      $name = $_POST['visitor_name'];
      $email = $_POST['visitor_email'];
      $subject = $_POST['visitor_subject'];
      $message = $_POST['visitor_message'];

      $recipient = "doctorphotoshop24@gmail.com";
      $subject ="Contact: " . $name;
      $fromname =$name;
      $fromemail = 'noreply@codeconia.com';  //if u dont have an email create one on your cpanel
      $mailto = 'doctorphotoshop24@gmail.com';  //the email which u want to recv this email


      $email_body = "<div>";
      $email_body .= "<div>
                   <label><b>Name:</b></label>&nbsp;<span>".$name."</span>
                   </div>";
      $email_body .= "<div>
                   <label><b>Email:</b></label>&nbsp;<span>".$email."</span>
                   </div>";
      $email_body .= "<div>
                   <label><b>Subject:</b></label>&nbsp;<span>".$subject."</span>
                   </div>";
      $email_body .= "<div>
                   <label><b>Message:</b></label>&nbsp;<span>".$message."</span>
                   </div>";
      $email_body .= "</div>";

      // a random hash will be necessary to send mixed content
      $separator = md5(time());
      // carriage return type (RFC)
      $eol = "\r\n";

      // main header (multipart mandatory)
      $headers = "From: ".$fromname." <".$fromemail.">" . $eol;
      $headers .= "MIME-Version: 1.0" . $eol;
      $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
      //$headers .= 'Content-type: text/html; charset=utf-8' . $eol;
      $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
      $headers .= "This is a MIME encoded message." . $eol;

      // message
      $body = "--" . $separator . $eol;
      $body .= 'Content-type: text/html; charset=utf-8' . $eol;
      $body .= "Content-Transfer-Encoding: 8bit" . $eol;
      $body .= $email_body . $eol;

      if (mail($mailto, $subject, $body, $headers)) {

      } else {
          echo '<p>We are sorry but the email did not go through.</p>';
      }
      }
?>
