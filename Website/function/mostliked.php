<?php 
session_start();
session_destroy();

setcookie("comments", "", time() - 3600, "/");
setcookie("views", "", time() - 3600, "/");  
setcookie("recent", "", time() - 3600, "/");

unset ($_COOKIE["views"]);
unset ($_COOKIE["recent"]);
unset ($_COOKIE["comments"]);

if(!isset($_COOKIE['likes']))
{
setcookie("likes", "1", time() + 3600, "/");      
}else{
    
if($_COOKIE['likes'] == 1)
{
setcookie("likes", "2", time() + 3600, "/");    
}

if ($_COOKIE['likes'] == 2)
{
setcookie("likes", "1", time() + 3600, "/");   
}  
}
header("Location: ../forum.php");
?>