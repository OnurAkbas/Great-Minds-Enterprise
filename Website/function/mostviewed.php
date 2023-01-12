<?php 
session_start();
session_destroy();

setcookie("comments", "", time() - 3600, "/");
setcookie("likes", "", time() - 3600, "/");
setcookie("recent", "", time() - 3600, "/");

unset ($_COOKIE["likes"]);
unset ($_COOKIE["recent"]);
unset ($_COOKIE["comments"]);

if(!isset($_COOKIE['views']))
{
setcookie("views", "1", time() + 3600, "/");      
}else{
    
if($_COOKIE['views'] == 1)
{
setcookie("views", "2", time() + 3600, "/");    
}

if ($_COOKIE['views'] == 2)
{
setcookie("views", "1", time() + 3600, "/");

}  
}
header("Location: ../forum.php");
?>