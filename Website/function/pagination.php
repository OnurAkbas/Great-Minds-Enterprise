<?php
session_start();

$requestedpage = $_REQUEST['page'];

if (isset($_REQUEST['status']))
{
$status = $_REQUEST['status'];
}else{
$status = "";    
}

if (isset($_SESSION["activepage"]))
{
    
}else{
$_SESSION["activepage"] = "1";   
}

if($status == "forward")
{
$_SESSION["activepage"] = ($_SESSION["activepage"] + 1);      
}
else if($status == "back")
{
$_SESSION["activepage"] = ($_SESSION["activepage"] - 1);
}
else
{
$_SESSION["activepage"] = $requestedpage;   
}
header("Location: ../forum.php");
exit();
?>