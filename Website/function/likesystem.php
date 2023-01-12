<?php 

include('../config/mysql.php');

$postID = $_REQUEST['postID'];
$userID = $_REQUEST['username'];
$status = $_REQUEST['status'];


if(isset($_COOKIE["user"]))
    {
    
    $sql = "SELECT user FROM userDB WHERE user = '$userID' and verified = '1'";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
        if($count == 0)
        {
            header("Location: ../verification.php", true, 301);
            exit();
        }   
    }
    }


if(isset($userID)){
    if($userID == "Guest"){
    header("Location: ../login.php");
    }else
    {    
    $getID = "SELECT * FROM userDB WHERE user = '$userID'";
    $result = mysqli_query($conn,$getID);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $userID = $row['id'];
}}

if(isset($status) && $status == "Like") {
    $status = "L";    
}elseif (isset($status) && $status == "Dislike"){
    $status = "D"; 
}
        $sql = "SELECT * FROM uLikes WHERE postID = '$postID' and userID = '$userID'";
        $result = mysqli_query($conn,$sql);
        if($result)
        
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count == 1)
			{
            $sql = "UPDATE uLikes SET status='$status' WHERE postID = '$postID' AND userID = '$userID'";
            mysqli_query($conn,$sql);
            header("Location: ../posts.php?postid=$postID"); 
            exit();
            }
            else
            {
                $sql = "INSERT INTO uLikes (userID, PostID, status) VALUES ('$userID', '$postID' , '$status')";
                mysqli_query($conn,$sql);
                header("Location: ../posts.php?postid=$postID"); 
                exit();       
            }
?>


