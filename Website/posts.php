<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}
include('config/mysql.php');
$postID = $_REQUEST['postid'];

if (!isset($_REQUEST['postid']))
{
header("Location: forum.php", true, 301);
exit();  
}

if (isset($_REQUEST['reason']))
{
$usernamee = $_COOKIE['user'];
$reason = $_REQUEST['reason'];
$sql = "INSERT INTO FlagDB (user, reason, ideaID) VALUES ('$usernamee', '$reason' , '$postID')";
mysqli_query($conn,$sql);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

if (!isset($_COOKIE['user']))  
{
header("Location: login.php"); 
exit();       
}else
{
$username = $_COOKIE['user'];
}
    
if(isset($_COOKIE["user"]))
    {
    $sql = "SELECT user FROM userDB WHERE user = '$username' and verified = '1'";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
        if($count == 0)
        {
            header("Location: verification.php", true, 301);
            exit();
        }   
    }
    }
    
$reply = mysqli_real_escape_string($conn,$_POST['Reply']);   
    
if (isset($_POST['anontick'])){
$anonpost = "1";   
}else{
$anonpost = "0";    
}
$sql = "INSERT INTO replyDB (postID, user, reply, anon, DOR, TOR) VALUES ('$postID', '$username' , '$reply' , '$anonpost' , NOW() , NOW())";
mysqli_query($conn,$sql);
    
$sqll = "SELECT *
FROM postDB p
LEFT JOIN userDB u on (p.user = u.user)
where p.id = '$postID'";
    
$resultt = mysqli_query($conn,$sqll) or die(mysqli_error());
$rowsss = mysqli_num_rows($resultt);
    
while($rowsss = mysqli_fetch_object($resultt)) {
    $email = "$rowsss->email";
    $owner = "$rowsss->user";
    $title = "$rowsss->title";
}

if ($owner != $username)
{
    
if ($anonpost == "1"){
$username = "Anonymous"; 
}
    
$subject = 'New Reply on your post  | By ' . $username ;
$message = "Hey, $owner \r\n". "A New reply has been posted to : " . $title ."\r\n\r\n" . 'Kind Regards';
    
$headers = 'From: noreply@gre.ac.uk' . "\r\n" .
'Reply-To: no-reply@gre.ac.uk' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
    
mail($email, $subject, $message, $headers);  
    
}
header("Location: posts.php?postid=$postID"); 
exit();           
}

$sql = "UPDATE postDB SET views = views + 1 WHERE id = '$postID'";
mysqli_query($conn,$sql); 

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


    <script>
    function flagIdea() {
    var txt;
    var reason = prompt("Why is this post inappropriate?", "");
    if (reason == null || reason == "") {
    } else {
    txt = "Your Report has been sent and will be viewed by and adminsitrator soon as possible.";
    window.location.replace("https://stuweb.cms.gre.ac.uk/~oa4933r/posts.php?postid=<?php echo $postID;?>&reason="+reason);
    }
    
    }
    </script>
       
   <?php include ("header.php") ?>
   <div class=container style=padding-top:80px>
            <div class="box first">
               <div class=row>
                   <?php
                    $sql = "SELECT * FROM postDB WHERE id = '$postID' ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    
                    if($row['anonn'] == 1)
                        {
                        $useranon = "Anonymous";
                        }else
                        {
                        $useranon = $row['user'];
                        }
                   ?>       
                   <center>
                   <?php 
                       if (isset($_COOKIE["user"])){
                       $user = $_COOKIE['user'];
                       }else
                       {
                           $user = "Guest";
                           
                           echo "<h4>Hey Guest, Please Log-in.<h4>";
                       }
                      ?>
                       <h2> Title : <?php echo $row['title'] ?></h2>
                       <?php
                        if (isset($_REQUEST['reason'])){
                            echo"<p>Your Report has been sent and will be viewed by and adminsitrator soon as possible.</p>";
                        }
                        ?>
                       <p id="demo"></p>
                   </center>
                  
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                       <section class="post-heading">
                            <div class="row">
                                <div class="col-md-11">
                                        <a href="#">
                                          <img class="post-picture" src="image/avatar.png" width="40" height="40" alt="ProfilePic">
                                        </a>
                                      <div class="post-header">
                                        <a href="#" class="username"><h4 class="username"><?php echo $useranon ?></h4></a> 
                                      </div>
                                </div>
                            </div>             
                       </section>
                       <section class="post-body">
                           <p class="post-text"><?php echo $row['description'] ?></p>
                           <p>-----------------------------------</p>
                           <?php
                            $newDate = date("d-m-Y", strtotime($row['DOI']));
                            $time = date("g:i a", strtotime($row['TOI']));
                            ?>
                           <p class="post-text"><?php echo "Date Of Post : " . $newDate ?></p>
                           <p class="post-text"><?php echo "Time : " . $time ?></p>
                       </section>
                       <section>
                           <hr>
                           <div class="container">
                               <div class="col-sm-12">
                                    <ul class="list-unstyled">
                                        
                        <?php
                        $sqll = "SELECT * FROM uLikes WHERE postID = '$postID' AND status = 'L' ";
                        $resultt = mysqli_query($conn, $sqll);
                        $num_rowss = mysqli_num_rows($resultt);
                        
                        if (isset($_COOKIE['user']))
                        { ?>

                        <li><a href="function/likesystem.php?postID=<?php echo $postID . "&" . "status=Like" . "&" . "username=".$user;?>"><i class="glyphicon glyphicon-thumbs-up"></i><?php echo " " . $num_rowss; ?> Like</a></li>
                        <?php
                        $sqll = "SELECT * FROM uLikes WHERE postID = '$postID' AND status = 'D' ";
                        $resultt = mysqli_query($conn, $sqll);
                        $num_rowss = mysqli_num_rows($resultt);                       
                        ?>
                        <li><a href="function/likesystem.php?postID=<?php echo $postID . "&" . "status=Dislike" . "&" . "username=".$user;?>"><i class="glyphicon glyphicon-thumbs-down"></i><?php echo " " . $num_rowss; ?> Dislike</a></li>
                        <?php
                        } else { ?>
                            
                        <li><a ><i class="glyphicon glyphicon-thumbs-up"></i><?php echo " " . $num_rowss; ?> Like</a></li>
                        <?php
                        $sqll = "SELECT * FROM uLikes WHERE postID = '$postID' AND status = 'D' ";
                        $resultt = mysqli_query($conn, $sqll);
                        $num_rowss = mysqli_num_rows($resultt);                       
                        ?>
                        <li><a ><i class="glyphicon glyphicon-thumbs-down"></i><?php echo " " . $num_rowss; ?> Dislike</a></li>
                               
                        <?php } 
                        $sqll = "SELECT * FROM replyDB WHERE postID = '$postID' ";
                        $resultt = mysqli_query($conn, $sqll);
                        $num_rowss = mysqli_num_rows($resultt);
                        ?>
                        <li><a ><i class="glyphicon glyphicon-eye-open"></i><?php echo " " . $row['views'] ?> Views</a></li>
                        <li><a ><i class="glyphicon glyphicon-comment"></i> <?php echo $num_rowss; ?> Comment</a></li>
                        
                        <?php 
                        if ($row['attachmentName'] == "")
                        {
                            
                        }else{
                        ?>
                        <li><a href="function/download.php?postID=<?php echo $postID; ?>"><i class="glyphicon glyphicon-save"></i> Download</a></li>
                        <?php } 
                                        
                        if (isset($_COOKIE['user']))
                        { ?>
                        <li><a onclick="flagIdea()"><i class="glyphicon glyphicon-flag"></i> Flag Idea</a></li>  
                        <?php } ?>
                        

                                    </ul>
                                </div>
                           </div>
                           <hr>
                           <div class="col-sm-11 col-sm-offset-1">
                               <div class="comment">
                                   <?php
                                    $sql = "select * FROM replyDB where postID = '$postID' ";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_array($result))
                                    {
                                    if ($row['anon'] == 1)
                                    {
                                    $showreplyuser = "Anonymous"; 
                                    }else{
                                    $showreplyuser = $row['user'];
                                    }
                                   ?>
                                     <div class="comment-header">
                                        <p><img class="profile-picture" src="image/avatar.png" width="32" height="32" alt="ProfilePic" title="test"></p>
                                        <a href="#" class="username"><h4 class="username"><?php echo "Username : " . $showreplyuser ?></h4></a>
                                     </div>
                                   
                                      <div class="comment-body">
                                        <p><?php echo "Reply :  " . $row['reply'] ?></p>
                                         <?php
                                        $replydate = date("d-m-Y", strtotime($row['DOR']));
                                        $replytime = date("g:i a", strtotime($row['TOR']));
                                        ?>
                                        <p>-----------------------------------</p>
                                      <p class="post-text"><?php echo "Date Of Post : " . $replydate ?></p>
                                      <p class="post-text"><?php echo "Time : " . $replytime ?></p>
                                        <p>-----------------------------------</p>
                                      </div>
                                   <br>
                                   <?php } ?>
                                
                               </div>
                           </div>
                       </section>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="reply">
                        <div class="reply-body">
                            <?php
                            if (isset($_COOKIE['user']))
                            { ?>
                            <form method="post">
                                <textarea class="form-control" type="text" placeholder="Enter Reply..." name="Reply" required></textarea>
                                <br>
                                <label class="reply-checkbox" ><input type="checkbox" name="anontick" value="anon"> Comment Anonymously <span class="glyphicon glyphicon-eye-close"></label>
                                <button class="btn btn-dark" name="btn_submit" type="submit">Reply <span class="glyphicon glyphicon-pencil"></span></button>
                            </form>
                            <?php }else{} ?>
                        </div>
                    </div>
                    <hr>
               </div>
            </div>
        </div>
    </div>
  </div>
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