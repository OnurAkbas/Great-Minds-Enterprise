<?php 
session_start();
session_destroy();

setcookie("comments", "", time() - 3600, "/");
setcookie("views", "", time() - 3600, "/");  
setcookie("likes", "", time() - 3600, "/");

unset ($_COOKIE["likes"]);
unset ($_COOKIE["views"]);
unset ($_COOKIE["comments"]);

if(!isset($_COOKIE['recent']))
{
setcookie("recent", "1", time() + 3600, "/");      
}else{
    
if($_COOKIE['recent'] == 1)
{
setcookie("recent", "2", time() + 3600, "/");    
}

if ($_COOKIE['recent'] == 2)
{
setcookie("recent", "1", time() + 3600, "/");   
}  
}
header("Location: ../forum.php");
?>