<?php 

$cata = $_REQUEST['cata'];

setcookie("comments" , "", time() - 3600, "/");
setcookie("cata", $cata, time() + 3600, "/");   

header("Location: ../forum.php");
?>