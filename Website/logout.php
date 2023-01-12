<?php 
session_start();
session_destroy();
setcookie("user", "", time() + 3600, "/");
setcookie("views", "", time() + 3600, "/");
unset ($_COOKIE["user"]);
unset ($_COOKIE["views"]);
header('Location: login.php');
exit();
?>