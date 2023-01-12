<?php
include('../config/mysql.php');

$postID = $_REQUEST['postID'];

$sql = "SELECT * FROM postDB WHERE id = '$postID' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


                header("Content-Type: ". $row['attachmentMime']);
                //header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['attachmentName']);
 
                // Print data
                echo $row['attachmentData'];
    
header("Location: ../posts.php?postid=$postID"); 
exit();  
?>