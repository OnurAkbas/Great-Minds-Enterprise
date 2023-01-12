<?php
?>
<header id=header role=banner>
 <div class=container>
    <div id=navbar class="navbar navbar-default">
       <div class=navbar-header>
          <button type=button class=navbar-toggle data-toggle=collapse data-target=.navbar-collapse>
          <span class=sr-only>Toggle navigation</span>
          <span class=icon-bar></span>
          <span class=icon-bar></span>
          <span class=icon-bar></span>
          </button>
          <a class=navbar-brand href=index.php></a>
       </div>
       <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
             <li class=active><a href=index.php><i class=icon-home></i></a></li>
             <li><a href="filter.php">Ideas Forum</a></li>
             <li><a href=team.php>The Team</a></li>
              <li><a href=contactus.php>Contact Us</a></li> 
             <?php if(isset($_COOKIE["user"])){?>
              <li><a href=profile.php>Profile</a></li>
              <li><a href=logout.php><?php echo $_COOKIE["user"] . " | ";  ?>Log Out</a></li>
             <?php }?>

            <?php if(!isset($_COOKIE["user"])){?>
             <li><a href=login.php>Login</a></li>
             <li><a href=register.php>Register</a></li>
            <?php }?>  
          </ul>
       </div>
    </div>
     <?php 
     if(isset($_COOKIE["user"]))
        {
        $username = $_COOKIE["user"];
        $sql = "SELECT user FROM userDB WHERE user = '$username' and verified = '1'";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
            if($count == 0)
			{
                ?>
                <div  class="alert alert-danger warningmessage">
  <strong>Warning!</strong> Your Account isn't Verified, Please Verify your account now <a href="verification.php">(Click Me)</a>.
</div><?php
            }   
        }
        }
     ?>
     <style>
         .warningmessage{
          margin-top : -18px;
          padding-bottom: 20px;
         }
     
     </style>
 </div>
    
</header>