<?php
include('config/mysql.php');

$username = $_COOKIE["user"];
$_SESSION['hello'] = "Hello, " . $username;
$_SESSION['error'] = "";
if(isset($_COOKIE["user"]))
        {
        $username = $_COOKIE["user"];
        $sql = "SELECT user FROM userDB WHERE user = '$username' and verified = '1'";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
            if($count == 1)
			{
                header("Location: forum.php", true, 301);
                exit();
            }   
        }
        }

  $check_user_query = "SELECT * FROM userDB WHERE verified = 0 and user = '$username'";
  $query_result = mysqli_query($conn,$check_user_query);
  $loggedin = mysqli_fetch_assoc($query_result);
  $valid  =  mysqli_num_rows($query_result);
  if (!$valid)
  {
  header("location:login.php");
  exit();   
  }


if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $veri = ($_POST['veri']);
  $username = $_COOKIE["user"];
  $check_user = "SELECT * FROM userDB where verification = '$veri'";
  $query_r = mysqli_query($conn,$check_user);
  $log = mysqli_fetch_array($query_r,MYSQLI_ASSOC);
  $val  =  mysqli_num_rows($query_r);

  if ($val == 1)
  {
    $update_query = "UPDATE userDB SET verified = '1' WHERE user = '$username'";
    mysqli_query($conn,$update_query);
    header("location:forum.php");
  } 
  else 
  {
    $_SESSION["error"] = "Invalid verification code. Please try again.";
  }
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
      
    <form method="post" action="">
      <div style=margin-top:120px>
         <div class=container>
            <div class="box first">
               <div class=row>
                  <center>
                      <div class="col-sm-12 col-md-6 col-md-offset-3">
                     <h1>Verification</h1>
                       <h3 class="success">
                        <?php
                        echo $_SESSION['hello'];
                        ?>
                        </h3>
                         <h3>
                        <?php
                        echo $_SESSION['error'];
                        ?>
                        </h3>
                
                <input type="text" id="Veri" class="form-control" placeholder="Enter Code" name="veri" required>
    

    <div class="clearfix">
      <button class="btn" type="submit" class="loginbtn">Verify</button> <br>
    </div>
    <a href="resendveri.php">Send New Code?</a>
        
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