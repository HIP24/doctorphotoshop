<?php

if($_POST) {
      $name = $_POST['visitor_name'];
      $email = $_POST['visitor_email'];
      $request = $_POST['visitor_request'];
      $urgency=$_POST['visitor_urgency'];
      $filenameee =  $_FILES['fileToUpload']['name'];
      $fileName = $_FILES['fileToUpload']['tmp_name'];

      $recipient = "doctorphotoshop24@gmail.com";
      $subject ="Appointment: " . $name;
      $fromname =$name;
      $fromemail = 'noreply@codeconia.com';  //if u dont have an email create one on your cpanel
      $mailto = 'doctorphotoshop24@gmail.com';  //the email which u want to recv this email


      $email_body = "<div>";
      $email_body .= "<div>
                   <label><b>Patient Name:</b></label>&nbsp;<span>".$name."</span>
                   </div>";
      $email_body .= "<div>
                   <label><b>Patient Email:</b></label>&nbsp;<span>".$email."</span>
                   </div>";
      $email_body .= "<div>
                   <label><b>Patient Urgency:</b></label>&nbsp;<span>".$urgency."</span>
                   </div>";
      $email_body .= "<div>
                   <label><b>Patient Request:</b></label>&nbsp;<span>".$request."</span>
                   </div>";
      $email_body .= "</div>";


      $content = file_get_contents($fileName);
      $content = chunk_split(base64_encode($content));

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

      // attachment
      $body .= "--" . $separator . $eol;
      $body .= "Content-Type: application/octet-stream; name=\"" . $filenameee . "\"" . $eol;
      $body .= "Content-Transfer-Encoding: base64" . $eol;
      $body .= "Content-Disposition: attachment" . $eol;
      $body .= $content . $eol;
      $body .= "--" . $separator . "--";

      $target_dir = "../uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }

      if (mail($mailto, $subject, $body, $headers)) {
          echo "<p>Your appointment is booked! You will hear from Dr. Photoshopina shortly.</p>";
      } else {
          echo '<p>We are sorry but the email did not go through.</p>';
      }
      }
?>