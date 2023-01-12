<?php
include('config/mysql.php');

if(isset($_COOKIE['user']))
{

}else{
header("Location: login.php", true, 301);
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

        <?php include ("header.php");
        $username = $_COOKIE['user'];
        $sql = "SELECT * FROM userDB WHERE user = '$username' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        
        ?>
        <div class=container style=padding-top:80px>
            <div class="box first">
                <div class=row>
                    <center>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-md-offset-3">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="member">
                                            <p><img class="img-responsive img-thumbnail img-circle" src="image/team/avatar.png" alt="" ></p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-12">
                                        <small class="profile-small">Profile of</small>
                                        <h3 class="profile-h3"><?php echo $_COOKIE['user'] ?>
                                            
                                        <?php 
                                        if($row['verified'] == 1)
                                        { ?>
                                        <span class="glyphicon glyphicon-ok"> </span>
                                        <?php }else{ ?>
                                        <span class="glyphicon glyphicon-remove"> </span>    
                                        <?php }
                                        ?> </h3>
                                            
                                        <hr>
                                        <h3>Social Media Links</h3>
                                        
                                    </div>
                                        <br>
                                        <label><b>Facebook</b></label>
                                        <input class="form-control" name="facebook" type="text" value="https://www.facebook.com/">
                                        <br>
                                        <label><b>Linkdin</b></label>
                                        <input class="form-control" name="linkdin" type="text" value="https://www.linkedin.com/in/">
                                        <br>
                                        <label><b>Instagram</b></label>
                                        <input class="form-control" name="instagram" type="text" value="https://www.instagram.com/">
                                        <br>
                                        <label><b>Youtube</b></label>
                                        <input class="form-control" name="youtube" type="text" value="https://www.youtube.com/">
                                        <br>
                                        <label><b>Twitter</b></label>
                                        <input class="form-control" name="twttier" type="text" value="https://www.twitter.com/">
                                    <br>
                                    <button class="btn btn-dark" name="btn_submit" type="submit">Edit Social Links <span class="glyphicon glyphicon-info-sign"></span></button>
                                    
                                    <hr>
                                    <h3>About Me</h3>
                                    
                                    <input class="form-control" name="aboutme" type="text" value="About Me...">
                                    <br>
                                    <button class="btn btn-dark" name="btn_submit" type="submit">Edit About Me <span class="glyphicon glyphicon-info-sign"></span></button>
                                    
                                    <hr>
                                        <h3>Change Password</h3>
                                        <br>
                                        <form>
                                            <input type="password" name="oldpass" class="form-control" placeholder="Old Password..." required/>
                                            <br>
                                            <input type="password" name="newpass" class="form-control" placeholder="New Password..." required/>
                                            <br>
                                            <input type="password" name="conpass" class="form-control" placeholder="Repeat Password..." required/>
                                            <br>
                                            <button class="btn btn-dark" name="btn_submit" type="submit">Change Password <span class="glyphicon glyphicon-lock"></span></button>
                                        </form>
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