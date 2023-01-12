<?php 

$cata = $_REQUEST['cata'];

setcookie("cata", $cata, time() + 3600, "/");   

header("Location: ../createPosts.php");
?>