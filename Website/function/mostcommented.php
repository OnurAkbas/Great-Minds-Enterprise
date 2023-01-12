<?php 
session_start();
session_destroy();

setcookie("likes", "", time() - 3600, "/");
setcookie("views", "", time() - 3600, "/"); 
setcookie("recent", "", time() - 3600, "/");

unset ($_COOKIE["likes"]);
unset ($_COOKIE["views"]);
unset ($_COOKIE["recent"]);

if(!isset($_COOKIE['comments']))
{
setcookie("comments", "1", time() + 3600, "/");      
}else{

if($_COOKIE['comments'] == 1)
{
setcookie("comments", "2", time() + 3600, "/");    
}

if ($_COOKIE['comments'] == 2)
{
setcookie("comments", "1", time() + 3600, "/");   
}  
}

header("Location: ../forum.php");
?>