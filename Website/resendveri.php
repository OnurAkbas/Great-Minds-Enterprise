<?php
include('config/mysql.php');
$username = $_COOKIE["user"];
$_SESSION['hello'] = "Hello, " . $username;
$_SESSION['error'] = "";

  $mysql = "SELECT verified from `userDB` WHERE user ='$username'";
  $output = mysqli_query($conn,$mysql);
  $user = mysqli_fetch_assoc($output);
  if(!empty($user))
  { 
    if($user["verified"] == '1')
    {
      $_SESSION["error"] = "Your account is already activated.";
      header('Location: profile.php'); 
      exit();
    }
    else
    {
      $randomnum = rand(10000,99999);
      $verificationcode = (int)$randomnum;
        
        $emailquery = mysqli_query($conn, "SELECT email FROM userDB WHERE user = '$username'");
        $remail = $emailquery->fetch_object()->email;
        
        $updatequery = "UPDATE userDB SET verification = '$verificationcode' WHERE user = '$username'";
        $updateresult = mysqli_query($conn,$updatequery);
        mysqli_close($conn);
        
        $to = $remail;
        $subject = 'University of Greenwich | Verifcation Code';
        $message = "Hey, $username \r\n" .'Thanks For Registering With UOG a Website Powered by Great Minds Enterprise' .  "\r\n\r\n" . 'Your Verfication Code is : ' . "$verificationcode \r\n\r\n" . 'http://stuweb.cms.gre.ac.uk/~oa4933r/verify.php' . "\r\n\r\n" . 'Kind Regards';
        $headers = 'From: noreply@gre.ac.uk' . "\r\n" .
        'Reply-To: gmegreenwich@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
        header("Location: verification.php", true, 301);
      exit();
    }
  }
  else
  {
    $_SESSION["error"] = "Invalid User. Please try again.";
    header('Location: login.php'); 
    exit();
  }
?>