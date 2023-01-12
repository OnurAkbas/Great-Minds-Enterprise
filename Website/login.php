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
                     <h1>Welcome to Great Minds Enterprise</h1>
    <span class="auser">Have not registered? <a href="register.php">Register</a></span>
    <hr>
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        <p>Please fill in this form to Login</p>
        <br>               
        <label><b>Display Name</b></label>
        <input type="text" placeholder="Enter Display Name" name="Username" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="Password" required>

        <label>
        <input type="checkbox" checked="checked" style="margin-bottom:15px"> Remember me?
        </label>

        <div class="clearfix">
          <button class="btn" type="submit" class="loginbtn">Log In</button> <br>
        </div>
    </div>
        
        <?php   //mysql Login System
        if(isset($_POST['Username']))
        {
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        $decrypt = md5($password);
        $sql = "SELECT user FROM userDB WHERE BINARY user = BINARY '$username' and pass = BINARY '$decrypt'";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count == 1)
			{
                //$_SESSION["username"] = $username;
                $cookie_name = "user";
                $cookie_value = $username;
                setcookie($cookie_name, $cookie_value, time() + 3600, "/");
                header('Location: forum.php');
                exit();
            }
            else
            {
                session_destroy();
                echo "Login failed, Check Your Log-in Details.";
            }
        }
        }
        ?>
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