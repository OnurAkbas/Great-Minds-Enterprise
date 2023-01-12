<?php 
session_start();
session_destroy();
setcookie("search", "", time() + 3600, "/");
setcookie("cata", "", time() + 3600, "/");
setcookie("comments", "", time() + 3600, "/");
setcookie("likes", "", time() + 3600, "/");
setcookie("views", "", time() + 3600, "/");
setcookie("recent", "", time() + 3600, "/");
unset ($_COOKIE["search"]);
unset ($_COOKIE["cata"]);
unset ($_COOKIE["comments"]);
unset ($_COOKIE["likes"]);
unset ($_COOKIE["views"]);
unset ($_COOKIE["recent"]);
header('Location: forum.php');
exit();
?>