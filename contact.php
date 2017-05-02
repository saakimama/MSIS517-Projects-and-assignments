<?php
   if(isset($_POST['submit'])) {
      if(empty($_POST['Firstname']) || empty($_POST['Lastname']) || empty($_POST['Email']) || empty($_POST['Message'])) {
          echo "Some of the fields are not accurate or were left blank.";
      }
      else {
              function clease_data ($data, $error = 'error') {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              if (strlen($data) == 0)
              {
                  echo($error);
              }
              else{
                  return $data;
              }
          }
          $firstname = clease_data($_POST['Firstname']);
          $lastname = clease_data($_POST['Lastname']);
          $email = clease_data($_POST['Email']);
          $message = clease_data($_POST['Message']);
          if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
              echo ("Email id is invalid");
              exit();
          }
          else {
              $emailmsg = "First Name: $firstname \nLast Name: $lastname \nEmail: $email \nReason: $message ";
              $emailsub = "Webpage contact";
              $myemail = "saaketh.balusu5@gmail.com";
              $email_from = "saakethsagar@gmail.com";
              $visitor_email = "saakimama@yahoo.in";
              $headers = "From: $email_from \r\n";
              $headers .= "Reply-To: $visitor_email \r\n";
              mail($myemail,$emailsub,$emailmsg,$headers);
              $mysqli = new mysqli("localhost", "id1207658_saakimama", "15isking", "id1207658_contact");
              if($mysqli){
                  $sqlins = "insert into Reason(First_name,Last_name,Email,Reason) values('$firstname','$lastname','$email','$message')";
                  if(($mysqli->query($sqlins)) === True){
                      echo "<p align='center'>Your request has been recorded</p>";
                      }
                      else{
                          echo "Insert failed";
                      }
                  }
                 $mysqli->close();
                }
        }
        echo "<h2 align='center'>Form submitted successfully</h2>";
        header('refresh:3;URL =index.html');
        exit();
    }
?>