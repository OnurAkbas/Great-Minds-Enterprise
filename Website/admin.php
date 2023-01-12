<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

include('config/mysql.php');
ob_start();
session_start();

?>
<!DOCTYPE html>
<html lang=en>
   <head>
      <meta charset=utf-8>
      <meta name=viewport content="width=device-width, initial-scale=1.0">
      <title>Great Minds Enterprise</title>
      <link href=css/bootstrap.min.css rel=stylesheet>
      <link href=css/font-awesome.min.css rel=stylesheet>
      <link href=css/prettyPhoto.css rel=stylesheet>
      <link href=css/main.css rel=stylesheet>
      <link href=css/table.css rel=stylesheet>
       <link href=css/admin.css rel=stylesheet>
   </head>
   <body>
    <?php include ("header.php") ?>
      
    <form method="post">
      <div style=margin-top:120px>
         <div class=container>
            <div class="box first">
                <center>
                    <div class="row">
                        <h1>Admin Dashboard</h1>
                        <hr>
                        <div class="col-xs-12 col-sm-6">
                            <div class="panel panel-info">
                                <div class="panel-heading" href="#"><h4>Top 5 Most Active Users</h4></div>
                                <div class="panel-body">
                                    
                                    <p>These are the top 5 most active users.</p>
                                    <div style="overflow-x:auto;">
                                        <?php
                                        $sqll = "SELECT * FROM userDB ORDER BY loggedamount DESC LIMIT 0, 5"; 
                                        if($resultt = mysqli_query($conn, $sqll))
                                        {
                                        if(mysqli_num_rows($resultt) > 0)
                                        {   
                                        ?>
                                            <table>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>User</th>
                                                    <th>Log Count</th>
                                                </tr>
                                        <?php 
                                        while($roww = mysqli_fetch_array($resultt))
                                        {      
                                        echo "<td>" . $roww['id'] . "</td>";
                                        echo "<td>" . $roww['user'] . "</td>"; 
                                        echo "<td>" . $roww['loggedamount'] . "</td><tr>"; 
                                        }?>
                                        </table>
                                <?php  }else{
                                            echo "No Banned Users!";
                                        }} ?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="panel panel-info">
                                <div class="panel-heading"><h4>Top 5 Most Active Posts</h4></div>
                                <div class="panel-body">
                                    <p>These Are the top 5 most Viewed Posts.</p>
                                <div style="overflow-x:auto;">
                                        <?php
                                        $sqll = "SELECT * FROM postDB ORDER BY views DESC LIMIT 0, 5"; 
                                        if($resultt = mysqli_query($conn, $sqll))
                                        {
                                        if(mysqli_num_rows($resultt) > 0)
                                        {   
                                        ?>
                                            <table>
                                                <tr>
                                                    <th>Post ID</th>
                                                    <th>Post Title</th>
                                                    <th>Views</th>
                                                </tr>
                                        <?php 
                                        while($roww = mysqli_fetch_array($resultt))
                                        {      
                                        echo "<td>" . $roww['id'] . "</td>";
                                        echo "<td>" . $roww['title'] . "</td>"; 
                                        echo "<td>" . $roww['views'] . "</td><tr>"; 
                                        }?>
                                        </table>
                                <?php  }else{
                                            echo "No Banned Users!";
                                        }} ?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="panel panel-info">
                                <div class="panel-heading" href="#"><h4>Banned Users</h4></div>
                                <div class="panel-body">
                                    <p>You can unban these users anytime for them to get back and start posting ideas and replying to posts</p>
                                    <div style="overflow-x:auto;">
                                        <?php
                                        $sqll = "SELECT * FROM userDB WHERE Banned = 1 LIMIT 0, 5"; 
                                        if($resultt = mysqli_query($conn, $sqll))
                                        {
                                        if(mysqli_num_rows($resultt) > 0)
                                        {   
                                        ?>
                                            <table>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>UserName</th>
                                                    <th>Email</th>
                                                </tr>
                                        <?php 
                                        while($roww = mysqli_fetch_array($resultt))
                                        {      
                                        echo "<td>" . $roww['id'] . "</td>";
                                        echo "<td>" . $roww['user'] . "</td>"; 
                                        echo "<td>" . $roww['email'] . "</td><tr>"; 
                                        }?>
                                        </table>
                                <?php  }else{
                                            echo "No Banned Users!";
                                        }} ?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="panel panel-info">
                                <div class="panel-heading" href="#"><h4>Flagged Ideas</h4></div>
                                <div class="panel-body">
                                    <p>Check Out these flagged ideas by staff, you can remove post or remove Flag. (try to keep clear all times.)</p>
                                    <div style="overflow-x:auto;">
                                        <?php
                                        $sql = "SELECT * FROM FlagDB ORDER BY id DESC LIMIT 0, 5"; 
                                        if($result = mysqli_query($conn, $sql))
                                        {
                                        if(mysqli_num_rows($result) > 0)
                                        {   
                                        ?>
                                            <table>
                                                <tr>
                                                    <th>Post Id</th>
                                                    <th>Reason</th>
                                                    <th>By User </th>
                                                </tr>
                                        <?php 
                                        while($row = mysqli_fetch_array($result))
                                        {      
                                        echo "<td>" . $row['ideaID'] . "</td>";
                                        echo "<td>" . $row['reason'] . "</td>"; 
                                        echo "<td>" . $row['user'] . "</td><tr>"; 
                                        }?>
                                        </table>
                                <?php  }else{
                                            echo "No Flagged Ideas";
                                        }} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
         </div>
      </div>
      <script src=js/jquery.js></script>
      <script src=js/bootstrap.min.js></script>
      <script src=js/jquery.isotope.min.js></script>
      <script src=js/jquery.prettyPhoto.js></script>
      <script src=js/main.js></script>
       </form>
   </body>
   <footer id=footer>
      <div class=container>
         <div class=row>
            <div class=col-sm-6>
               &copy; 2018 <a id=hyperlink1 > University Of Greenwich | Website Powered and Designed By Great Minds Enterprise</a>
            </div>
         </div>
      </div>
   </footer>