<?php
include('config/mysql.php');
session_start();

if (!isset($_COOKIE['search'])){
        $cookie_name = "search";
        $cookie_value = "";
        setcookie($cookie_name, $cookie_value, time() + 3600, "/");
    }else{
        
    }

if (isset($_POST['btn_submit']))
{
$filtersearch = mysqli_real_escape_string($conn,$_POST['search']);
$cookie_name = "search";
setcookie($cookie_name, $filtersearch, time() + 3600, "/");
setcookie("views", "5", time() - 3600, "/");
unset ($_COOKIE["views"]);
$_SESSION['activepage'] = "1";
header("Location: forum.php", true, 301);
exit();
}

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
        <link href=css/boxx.css rel=stylesheet>
        <link href=css/table.css rel=stylesheet>
        <link rel=icon href=images/ico/i512.png>
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
        <script>
            window.addEventListener("load", function() {
                window.cookieconsent.initialise({
                    "palette": {
                        "popup": {
                            "background": "#252e39"
                        },
                        "button": {
                            "background": "#14a7d0"
                        }
                    },
                    "content": {
                        "href": "TandC"
                    }
                })
            });
        </script>
    </head>
    <body>
        <form method="post">
                <script type="text/javascript">
                    function DoNav(theUrl) {
                        document.location.href = theUrl;
                    }

                    $(function() {
                        $("#drop").change(function() {
                            var selectedText = $(this).val();
                            var v = [];
                            $(".select_drop").each(function() {
                                v.push($(this).val());
                            })
                            if ($.inArray(selectedText, v) >= 0) {
                                alert('your alert');
                                location.reload();
                            }

                        })
                    })
                </script>

                <?php include ("header.php") ?>
                <div class=container style=padding-top:80px>
                    <div class="box first">
                        <div class=row>
                            <center>
                                <div>
                                    <h3>Welcome To The Ideas Forum Page</h3>
                                </div>
                                <div>
                                    <?php 
                       if (isset($_COOKIE["user"])){
                           echo "<h4><b>Hello " . $_COOKIE["user"] . "</b></h4>";
                       }else
                       {
                           echo "<h4>Hey Guest, Please Login.<h4>";
                       }
                      ?>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="input-group">
                                                <div class="input-group-btn search-panel">
                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                                                    <?php
                                                    if (isset($_COOKIE['cata']))
                                                    {
                                                    $selectedcata = $_COOKIE['cata'];
                                                    }else
                                                    {
                                                    $selectedcata = "Categories";
                                                    }
                                                    ?>
                                                    <span><?php echo $selectedcata ?></span> <span class="glyphicon glyphicon-chevron-down"></span>
                                                </button>
                                                    <ul class="dropdown-menu" role="menu" >
                                                        <li><a href="filter.php">All</a></li>
                                                        <li class="divider"></li>
                                                        <?php
                                                    $sql = "SELECT * FROM categoriesDB;";    
                                                    if($result = mysqli_query($conn, $sql))
                                                    {
                                                    if(mysqli_num_rows($result) > 0)
                                                    { 
                                                     while($row = mysqli_fetch_array($result))
                                                    { 
                                                         if(isset($_COOKIE['cata']))
                                                         {
                                                             $cata = $_COOKIE['cata'];
                                                         }else{
                                                             $cata = "";
                                                         }
                                                        if($cata == $row['categorie'])
                                                        {
                                                        
                                                        }else{
                                                        ?>
                                                            <li >
                                                                <a href="function/Catagories.php?cata=<?php echo $row['categorie']; ?>">
                                                                    <?php echo $row['categorie']; 
                                                                    ?>
                                                                </a>
                                                                
                                                            </li>
                                                            <?php } } } }?>
                                                    </ul>
                                                </div>
                                                <?php
                                                
                                                ?>
                                                <input type="text" name="search" class="form-control" placeholder="Search for a Post...">
                                                <span class="input-group-btn">
                                                <button class="btn btn-dark" name="btn_submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <br> 
                                    <?php
                              if (isset($_COOKIE['user']))
                              { ?>
                                    <button type="button" class="btn btn-dark"><a href="createPosts.php"> Create Post <span class="glyphicon glyphicon-plus"></span></a></button>
                            <?php }  ?>
                                </div>
                            </center>
                            <div style=padding-top:50px>
                                <center> 
                                    <?php
                        if(isset($_COOKIE['cata']))                                                          // if the catagorey is set then show catagory
                        {
                        $catagory = $_COOKIE['cata']; 
                                            
                        if (!isset($_COOKIE['views']) || $_COOKIE['views'] == 2)                            // default show most viewed catagory
                        {
                        $sql = "SELECT * FROM postDB WHERE category = '$catagory' ORDER BY views ASC";     
                        }else                                                                               // if edited change to desc (less viewed).
                        $sql = "SELECT * FROM postDB WHERE category = '$catagory' ORDER BY views DESC";  
                        }else{                                                                               // if it isn't set then dont show catagory    
                        if(isset($_COOKIE['search'])){                                                      // if searched then show searched results
                        $searching = $_COOKIE['search'];
                        }
                        if (isset($_COOKIE['views']))                                                       // check if views is still set?
                        {
                        if ($_COOKIE['views'] == 1)                                                         // if views is set 
                        {
                        if (isset($_COOKIE['search']))                                                      // if search is set then
                        {
                        $sql = "SELECT * FROM postDB WHERE title LIKE '%$searching%' ORDER BY views DESC";    
                        }else{                                                                              // search is not set and views not set and no catagoery
                        $sql = "SELECT * FROM postDB ORDER BY views DESC";
                        }
                        }else{
                        if (isset($_COOKIE['search']))                                                      // if search is set 
                        {
                        $sql = "SELECT * FROM postDB WHERE title LIKE '%$searching%' ORDER BY views ASC";   // show most viewed searched result.
                        }else{ 
                        $sql = "SELECT * FROM postDB ORDER BY views ASC";                                   // or show most viewed as default no cata no search
                        }
                        }    
                        }else{
                        if (isset($_COOKIE['search']))                                                      // if search is set
                        {
                        $sql = "SELECT * FROM postDB WHERE title LIKE '%$searching%' ORDER BY id DESC";     // show search results from the most recent
                        }else
                        {
                        $sql = "SELECT * FROM postDB ORDER BY id DESC";                                     // show all results from most recent.
                        }                            
                        } 
                        }
                        if (isset($_COOKIE['comments']))                                                      // default show most viewed comment
                        {
                            if ($_COOKIE['comments'] == 1) {
                            $sql = "
                            SELECT p.id, p.user, p.title, p.DOI, p.anonn, p.views, p.category, b.postID, count(b.postID) as comments
                            FROM postDB p
                            LEFT JOIN replyDB b on (b.postID = p.id )       
                            GROUP BY p.id
                            ORDER BY comments DESC";      
                        }else{
                        $sql = "
                            SELECT p.id, p.user, p.title, p.DOI, p.anonn, p.views, p.category, b.postID, count(b.postID) as comments
                            FROM postDB p
                            LEFT JOIN replyDB b on (b.postID = p.id )       
                            GROUP BY p.id
                            ORDER BY comments ASC";
                                }
                        }                                                    // change to desc (less commented).
                        if (isset($_COOKIE['likes']))
                        {
                            if ($_COOKIE['likes'] == 1) {
                            $sql = "SELECT p.id, p.user, p.title, p.DOI, p.anonn, p.views, p.category, b.postID, count(case b.status when 'L' then 1 else null end) as Likes, COUNT(case b.status when 'D' then 1 else null end) as Dislikes
                            FROM postDB p
                            LEFT JOIN uLikes b on (b.postID = p.id)
                            GROUP BY p.id
                            ORDER BY Likes DESC";      
                        }
                        else
                        {
                        $sql = "SELECT p.id, p.user, p.title, p.DOI, p.anonn, p.views, p.category, b.postID, count(case b.status when 'L' then 1 else null end) as Likes, COUNT(case b.status when 'D' then 1 else null end) as Dislikes
                            FROM postDB p
                            LEFT JOIN uLikes b on (b.postID = p.id)
                            GROUP BY p.id
                            ORDER BY Dislikes DESC";
                        }
                        }
                        if (isset($_COOKIE['recent']))
                        {
                            if ($_COOKIE['recent'] == 1) {
                            $sql = "SELECT * FROM postDB ORDER BY DOI ASC";      
                        }
                        else
                        {
                        $sql = "SELECT * FROM postDB ORDER BY DOI DESC"; 
                        }
                        }
                                    
                                    
                        $_SESSION["sqllist"] = $sql;
                        
                                    
                                    
                        if (isset($_SESSION["activepage"]))
                        {
                        $pagecaluclator = ($_SESSION["activepage"] * 5 - 5);    
                        $sql = $sql . " " ."LIMIT ". $pagecaluclator . ", 5;";    
                        }
                        else
                        {
                        $sql = $sql . " " ."LIMIT 0, 5;";    
                        }
                        
                        if($result = mysqli_query($conn, $sql))
                        {
                        if(mysqli_num_rows($result) > 0)
                        { 
                            ?>
                                        <div style="overflow-x:auto;">
                                            <table>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Category </th>
                                                    <th onclick="DoNav('https://stuweb.cms.gre.ac.uk/~oa4933r/function/mostcommented.php');">Comments 
                                                        <?php
                                if (!isset($_COOKIE['comments']) OR ($_COOKIE['comments']) == 1){
                                ?> <span class="glyphicon glyphicon-comment"></span> <span class="glyphicon glyphicon-arrow-up"></span></th>
                                                    <?php
                                }else{
                                ?> <span class="glyphicon glyphicon-comment"></span> <span class="glyphicon glyphicon-arrow-down"></span></th>
                                                        <?php   
                                }
                            
                                ?>
                                                    <th onclick="DoNav('https://stuweb.cms.gre.ac.uk/~oa4933r/function/mostliked.php');">Likes & Dislikes
                                                     <?php  
                                if (!isset($_COOKIE['likes']) OR ($_COOKIE['likes']) == 1){
                                ?> <span class="glyphicon glyphicon-thumbs-up"></span></th>
                                                    <?php
                                }else{
                                ?> <span class="glyphicon glyphicon-thumbs-down"></span></th>
                                                        <?php   
                                }
                            
                                ?>
                                                    
                                                    
                                                    </th>
                                                    <th onclick="DoNav('https://stuweb.cms.gre.ac.uk/~oa4933r/function/mostviewed.php');">Views
                                                        <?php  
                                if (!isset($_COOKIE['views']) OR ($_COOKIE['views']) == 1){
                                ?> <span class="glyphicon glyphicon-circle-arrow-up"></span></th>
                                                    <?php
                                }else{
                                ?> <span class="glyphicon glyphicon-circle-arrow-down"></span></th>
                                                        <?php   
                                }
                            
                                ?>
                                                        <th>By User</th>
                                                        <th onclick="DoNav('https://stuweb.cms.gre.ac.uk/~oa4933r/function/mostrecent.php');">Date Of Idea 
                            <?php
                            if (!isset($_COOKIE['recent']) OR ($_COOKIE['recent']) == 1){ ?>
                            <span class="glyphicon glyphicon-circle-arrow-up"></span></th>
                            <?php }else{ ?>
                            <span class="glyphicon glyphicon-circle-arrow-down"></span></th>
                            <?php }
                                                            ?> 
                                                </tr>
                                                <?php
        
                        while($row = mysqli_fetch_array($result))
                        {
                        $postID = $row['id'];
                        $sqll = "SELECT * FROM replyDB WHERE postID = '$postID' ";
                        $resultt = mysqli_query($conn, $sqll);
                        $num_rowss = mysqli_num_rows($resultt);
                            
                        $sqlll = "SELECT * FROM uLikes WHERE postID = '$postID' AND status = 'L' ";
                        $resulttt = mysqli_query($conn, $sqlll);
                        $num_rowsss = mysqli_num_rows($resulttt);
                            
                        $sqlll = "SELECT * FROM uLikes WHERE postID = '$postID' AND status = 'D' ";
                        $resultttt = mysqli_query($conn, $sqlll);
                        $num_rowssss = mysqli_num_rows($resultttt);
                            
                            
                        $newDate = date("d-m-Y", strtotime($row['DOI']));    
                        if($row['anonn'] == 1)
                        {
                        $useranon = "Anonymous";
                        }else
                        {
                        $useranon = $row['user'];
                        }
                        ?>
                        <tr onclick="DoNav('https://stuweb.cms.gre.ac.uk/~oa4933r/posts.php?postid=<?php echo $row['id'];?>');">
                        <?php 
                           
                        echo "
                        <td>".$row['id']."</td>
                        <td>  ".$row['title']."</td>
                        <td>  ".$row['category']."</td>
                        <td>" . $num_rowss . "</td>
                        <td>  <div class='likes'>" . $num_rowsss . " : Likes</div><div class='dislikes'> ". $num_rowssss . " : Dislikes </div></td>
                        <td> " . $row['views'] . " : Views </td>
                        <td> ".$useranon."</td>
                        <td> ".$newDate."</td><tr>
                        ";
                        }
                        mysqli_free_result($result);
                        } else{
                            echo "<h3>No Results Were Found..</h3>";
                        }
                        }
                    ?>
                                            </table>
                                        </div>
                                </center>
                                <div class="pagination">
                                    <?php
                    
                    if (isset($_SESSION["sqllist"]))
                    {
                    $sql = $_SESSION["sqllist"];    
                    }else{
                    $sql = "SELECT * FROM postDB";
                    }
                                    
                    $result = mysqli_query($conn, $sql);
                    $num_rows = mysqli_num_rows($result);
                    //echo $num_rows;
                    $pagelist = ceil($num_rows / 5);
                    
                    $loop_pagelist = 1;
                    if (isset($_SESSION["activepage"]))
                    {
                    $activepage = $_SESSION["activepage"];   
                    }else{
                    $activepage = "1";    
                    }
                    if ($activepage == "1")
                    {
                        
                    }else{
                        if ($pagelist == "0")
                        {
                            
                        }else{
                    ?> <a href="function/pagination.php?page=<?php echo $loop_pagelist . "&" . "status=back"; ?>"> &laquo;</a>
                    <?php } }
                    //cookies to check which page is active (needs to be created)
                    while ($loop_pagelist <= $pagelist) 
                    {
                    if ($activepage == $loop_pagelist)
                    {
                    ?> <a class="active" href="function/pagination.php?page=<?php echo $loop_pagelist; ?>"> <?php echo $loop_pagelist ?> </a> <?php    
                    } else {  ?> 
                   
                    <a href="function/pagination.php?page=<?php echo $loop_pagelist; ?>"> <?php echo $loop_pagelist ?> </a>
                    <?php
                    }
                    $loop_pagelist++;
                    }
                    if ($activepage != $pagelist){
                        if ($pagelist == "0")
                        {
                            
                        }else{
                    ?> <a href="function/pagination.php?page=<?php echo ($loop_pagelist - 1). "&" . "status=forward" ?>"> &raquo;</a>  <?php    
                    } } ?>
                    
                    </div>
                    </div>
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
                <div class=col-sm-7>
                    &copy; 2018 <a id=hyperlink1> University Of Greenwich | Website Powered and Designed By Great Minds Enterprise</a>
                </div>
            </div>
        </div>
    </footer>