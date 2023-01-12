<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

include('config/mysql.php');
ob_start();
session_start();
 $_SESSION['error'] =  "";

// Post Check and variables created
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = ($_POST['email']);
    $subject = ($_POST['subject']);
    $message = ($_POST['message']);

    // Perform query to send email
    $to = 'gmegreenwich@gmail.com';
    $subject = 'GME Support: ' . "$subject";
    $message = "$message" . "\r\n" . 'by: ' . "$email";
    $headers = 'From: '."$email". "\r\n" .
        'Reply-To:'."$email". "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
    $_SESSION['error'] =  "Your email has been sent!";
}

?>
<!DOCTYPE html>
<html lang=en>
   <head>
      <meta charset=utf-8>
      <meta name=viewport content="width=device-width, initial-scale=1.0">
      <title>Great Minds Enterprise</title>
      <link href=css/bootstrap.min.css rel=stylesheet>
      <link href=css/font-awesome.min.css rel=stylesheet>
      <link href=css/prettyPhoto.css rel=stylesheet>
      <link href=css/main.css rel=stylesheet>
      <link href=css/forms.css rel=stylesheet>
   </head>
   <body>
      <?php include ("header.php") ?>
      
    <form method="post">
      <div style=margin-top:120px>
         <div class=container>
            <div class="box first">
               <div class=row>
                  <center>
                     <h1>Great Minds Enterprise Help Desk</h1>
                      <hr>
    <h3 class="success">
    <?php
    echo $_SESSION['error'];
    ?>
    </h3>
    <br>
    <div class="col-sm-12 col-md-8 col-md-offset-2">
    <p>Please fill in the form<p>
    <br>               
    <label><b>Email</b></label>
    <input type="Email" placeholder="Enter Your Email" name="email" required>

    <label><b>Subject</b></label>
    <input type="text" placeholder="Enter a Subject" name="subject" required>
  
    <label><b>Message</b></label>
    <textarea name="message" placeholder="Enter a Message" style="resize: none;" required></textarea>

    <div class="clearfix">
      <button class="btn" type="submit">Send</button> <br>
    </div>
                    </div>
                  </center>
               </div>
            </div>
         </div>
      </div>
      <script src=js/jquery.js></script>
      <script src=js/bootstrap.min.js></script>
      <script src=js/jquery.isotope.min.js></script>
      <script src=js/jquery.prettyPhoto.js></script>
      <script src=js/main.js></script>
       </form>
   </body>
   <footer id=footer>
      <div class=container>
         <div class=row>
            <div class=col-sm-6>
               &copy; 2018 <a id=hyperlink1 > University Of Greenwich | Website Powered and Designed By Great Minds Enterprise</a>
            </div>
         </div>
      </div>
   </footer>