<?php
include('config/mysql.php');
session_start();

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
            header("Location: verification.php", true, 301);
            exit();   
            }   
        }
        }else{
         header("Location: login.php", true, 301);
         exit();
     }


if (isset($_POST['btn_submit']))
{
$title = mysqli_real_escape_string($conn,$_POST['title']);
$description = mysqli_real_escape_string($conn,$_POST['description']);

if(isset($_COOKIE['cata']))
{
$catagorey = $_COOKIE['cata'];
}else{
$_SESSION['ERROR'] = "You have not selected an Catagory";
header("Location: createPosts.php", true, 301);
exit();  
}

if (isset($_POST['anontick'])){
$anonpost = "1";   
}else{
$anonpost = "0";    
}
    
$username = $_COOKIE["user"];
    
  if($_FILES['uploaded_file']['error'] == 0) {

        $name = $conn->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $conn->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $conn->real_escape_string(file_get_contents($_FILES ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
    
$sql = "INSERT INTO postDB (user, anonn, title, category, description, attachmentName, attachmentData, attachmentMime, DOI, TOI) VALUES ('$username', '$anonpost' , '$title','$catagorey','$description','$name','$data','$mime', NOW() , NOW())";
    
}
    else
{
        
$sql = "INSERT INTO postDB (user, anonn, title, category, description, DOI, TOI) VALUES ('$username', '$anonpost' , '$title', '$catagorey'  , '$description', NOW() , NOW())"; 
        
}
mysqli_query($conn,$sql);

$sqll = "SELECT c.id, c.user, u.email 
FROM categoriesDB c
LEFT JOIN userDB u on (c.user = u.user)
Where c.categorie = '$catagorey'";
$resultt = mysqli_query($conn,$sqll) or die(mysqli_error());
$rowsss = mysqli_num_rows($resultt);
    
while($rowsss = mysqli_fetch_object($resultt)) {
    $email = "$rowsss->email";
    $qamanager = "$rowsss->user";
}
    
if ($anonpost == "1"){
$username = "Anonymous"; 
}

$subject = 'New Post created | By ' . $username ;
$message = "Hey, $qamanager \r\n". "A New idea has been posted to : " . $catagorey ."\r\n\r\n" . 'Kind Regards';
    
$headers = 'From: noreply@gre.ac.uk' . "\r\n" .
'Reply-To: no-reply@gre.ac.uk' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
    
mail($email, $subject, $message, $headers);   
    
header("Location: forum.php", true, 301);
exit();
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
        <link href=css/boxx.css rel=stylesheet>
        <link href=css/table.css rel=stylesheet>
        <link rel=icon href=images/ico/i512.png>

        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
        <script>
            window.addEventListener("load", function() {
                window.cookieconsent.initialise({
                    "palette": {
                        "popup": {
                            "background": "#252e39"
                        },
                        "button": {
                            "background": "#14a7d0"
                        }
                    },
                    "content": {
                        "href": "TandC"
                    }
                })
            });
        </script>
    </head>
    <body>
        <script type="text/javascript">
            function DoNav(theUrl) {
                document.location.href = theUrl;
            }

            $(function() {
                $("#drop").change(function() {
                    var selectedText = $(this).val();
                    var v = [];
                    $(".select_drop").each(function() {
                        v.push($(this).val());
                    })
                    if ($.inArray(selectedText, v) >= 0) {
                        alert('your alert');
                        location.reload();
                    }

                })
            })
        </script>

        <?php include ("header.php") ?>
        <div class=container style=padding-top:80px>
            <div class="box first">
                <div class=row>
                    <center>
                        <div>
                            <?php 
                               if (isset($_COOKIE["user"])){
                                   echo "<h4><b>Your Posting As : " . $_COOKIE["user"] . "</b></h4>";
                               }else
                               {
                                   echo "<h4>Hey Guest, Please Login.<h4>";
                               }
                               if (isset($_SESSION["ERROR"]))
                               {
                               echo "<h2>Error : " . $_SESSION["ERROR"]."</h2>";
                               }
                            ?>
                            <h3>Create your post</h3>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-md-offset-3">
                                    <form class="cPosts-body" action="" method="post" enctype="multipart/form-data">
                                        <div class="col-md-12 text-center">
                                            <div class="dropdown btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                                                    <?php
                                                    if (isset($_COOKIE['cata']))
                                                    {
                                                    $selectedcata = $_COOKIE['cata'];
                                                    }else
                                                    {
                                                    $selectedcata = "Categories";
                                                    }
                                                    ?>
                                                    <span><?php echo $selectedcata ?></span> <span class="glyphicon glyphicon-chevron-down"></span>
                                                </button>
                                                    <ul class="dropdown-menu" role="menu" >
                                                        <?php
                                                    $sql = "SELECT * FROM categoriesDB;";    
                                                    if($result = mysqli_query($conn, $sql))
                                                    {
                                                    if(mysqli_num_rows($result) > 0)
                                                    { 
                                                     while($row = mysqli_fetch_array($result))
                                                    { 
                                                         if(isset($_COOKIE['cata']))
                                                         {
                                                             $cata = $_COOKIE['cata'];
                                                         }else{
                                                             $cata = "";
                                                         }
                                                        if($cata == $row['categorie'])
                                                        {
                                                        
                                                        }else{
                                                        ?>
                                                            <li >
                                                                <a href="function/CCatagories.php?cata=<?php echo $row['categorie']; ?>">
                                                                    <?php echo $row['categorie']; 
                                                                    ?>
                                                                </a>
                                                                
                                                            </li>
                                                            <?php } } } }?>
                                                    </ul>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="text" class="form-control" name="title" placeholder="Title..." pattern=".{6,30}" required/>
                                        <br>
                                        <textarea class="form-control" type="text" name="description" placeholder="Idea Description..." name="Reply" pattern=".{10,50}" required></textarea>
                                        <br>
                                        <input name="uploaded_file" type="file" class="form-control" placeholder='Choose a file...' />
                                        <br>
                                        <label class="posts-checkbox" ><input type="checkbox" required> I Accept The  <a href="TandC.html" target="_blank">Terms and Conditions</a>. <span class="glyphicon glyphicon-file"></span></label>
                                        <label class="posts-checkbox" ><input type="checkbox" name="anontick" value="anon"> Post Anonymously <span class="glyphicon glyphicon-eye-close"></span></label>
                                        <button class="btn btn-dark" name="btn_submit" type="submit">Post <span class="glyphicon glyphicon-pencil"></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
        <script src=js/jquery.js></script>
        <script src=js/bootstrap.min.js></script>
        <script src=js/jquery.isotope.min.js></script>
        <script src=js/jquery.prettyPhoto.js></script>
        <script src=js/main.js></script>
    </body>

    <footer id=footer>
        <div class=container>
            <div class=row>
                <div class=col-sm-7>
                    &copy; 2018 <a id=hyperlink1> University Of Greenwich | Website Powered and Designed By Great Minds Enterprise</a>
                </div>
            </div>
        </div>
    </footer>