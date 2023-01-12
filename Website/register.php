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
$_SESSION['error'] = "";
if(isset($_COOKIE["user"])){
    header("Location: Profile.php", true, 301);
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["CInput"])&&$_POST["CInput"]!=""&&$_SESSION["code"]==$_POST["CInput"]){
        $totalsum = $_SESSION['totalsum'];
        $totalint = (int)$totalsum;

        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['Password']);
        $encript = md5($password);
        $email = mysqli_real_escape_string($conn,$_POST['Email']);
        $atgre = mysqli_real_escape_string($conn,$_POST['Atgre']);

        $validation = "SELECT user FROM userDB WHERE user = '$username'";
        $validResult = mysqli_query($conn,$validation);
        $validCount = mysqli_num_rows($validResult);

        $password1 = $_POST['Password'];   
        $password2 = $_POST['PasswordConfirm'];

        if($validCount != 1)
        {
            if($password1 == $password2)
            {
                $femail = $email.$atgre;
                $randomnum = rand(10000,99999);
                $verificationcode = (int)$randomnum;
                $sql = "INSERT INTO userDB (user, pass, email, verification) VALUES ('$username', '$encript' , '$femail', ' $verificationcode' )";
                mysqli_query($conn,$sql);

                $subject = 'University of Greenwich | Verifcation Code';
                $message = "Hey, $username \r\n" .'Thanks For Registering With UOG a Website Powered by Great Minds Enterprise' .  "\r\n\r\n" . 'Your Verfication Code is : ' . "$verificationcode \r\n\r\n" . 'http://stuweb.cms.gre.ac.uk/~oa4933r/verify.php' . "\r\n\r\n" . 'Kind Regards';
                $headers = 'From: noreply@gre.ac.uk' . "\r\n" .
                'Reply-To: gmegreenwich@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                mail($email, $subject, $message, $headers);
                $cookie_name = "user";
                $cookie_value = $username;
                setcookie($cookie_name, $cookie_value, time() + 3600, "/");
                header("Location: verification.php", true, 301);
                exit();
            }
            else
            {
            $_SESSION['error'] = "Your Passwords Do not Match!";
            }
        }
        else
        {
        $_SESSION['error'] =  "This username is already listed, Please pick another Username.";
        }    
    }
    else
    {
    $_SESSION['error'] =  "Captcha Incorrect!";
    }
}
?>
<!DOCTYPE html>
<html lang=en>
    <head>
      <meta charset=utf-8>
      <meta name=viewport content="width=device-width, initial-scale=1.0">
      <title>University Of Greenwich</title>
      <link href=css/bootstrap.min.css rel=stylesheet>
      <link href=css/font-awesome.min.css rel=stylesheet>
      <link href=css/prettyPhoto.css rel=stylesheet>
      <link href=css/main.css rel=stylesheet>
      <link href=css/forms.css rel=stylesheet>
      
      <link rel=icon href=images/ico/i512.png>
    </head>
   <body>
      <?php include ("header.php") ?>
      <div style="margin-top: 70px;">
       </div>
    
       
    <form method="post" class="registration" id="registration">
      <div style=padding-top:50px>
         <div class=container>
            <div class="box first">
               <div class=row>
                  <center>
    <h1>Welcome to University Of Greenwich</h1>
    <span class="auser">Already registered? <a href="login.php">Login</a></span> 
    <hr>
    <div class="col-sm-12 col-md-6 col-md-offset-3">
    <p>Please fill in this form to create an account.</p>
    <div>
    <p>Note: This Register is only for Staff Members For Greenwich University.</p>                  
    </div>
    
                      
                      
                      
    <br>
    <label><b>Display Name</b></label>
    <input type="text" id="sername" placeholder="Enter Username" name="username" tabindex="1" minlength="5" required>
        	<label for="username">
        <ul class="input-requirements">
            <li>At least 5 characters long</li>
            <li>Must only contain letters and numbers (no special characters)</li>
    </ul>
        
    <label><b>Email</b></label>
    <div class="emaill">
    <input type="text" id="emaill" placeholder="Enter Email" name="Email" tabindex="1" minlength="5" required>
    
    </div>
    <div class="emailr">
    <input type="text" value="@greenwich.ac.uk" name="Atgre" readonly>
    </div>                
    <label><b>Password</b></label>
    <input type="password" id="password" placeholder="Enter Password" name="Password" maxlength="100" minlength="8" tabindex="3" required>
        <label for="password">
        <ul class="input-requirements">
					<li>At least 8 characters long (and less than 100 characters)</li>
					<li>Contains at least 1 number</li>
					<li>Contains at least 1 lowercase letter</li>
					<li>Contains at least 1 uppercase letter</li>
					<li>Contains a special character (e.g. @ !)</li>
				</ul>
    <label><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="PasswordConfirm" tabindex="4" required>
    
    <label><b>Captcha</b></label>
    <div>
    <img src="captcha.php" alt="Captcha">
    </div>
    <input type="text" placeholder="Please Enter Captcha" name="CInput">
  
    <p>By creating an account you agree to our <a href="TandC.html" style="color:dodgerblue">Terms & Conditions</a>.</p>

    <div class="clearfix">
      <button class="btn" type="submit">Register</button> <br>
    </div>         
                          </div>
                  </center>
               </div>
            </div>
         </div>
      </div>
      <script src=js/validator.js></script>
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
               &copy; 2018 <a id=hyperlink1>University Of Greenwich | Website Powered and Designed By Great Minds Enterprise</a>
            </div>
         </div>
      </div>
   </footer>