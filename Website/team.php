<?php
include('config/mysql.php');
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
      <!--[if lt IE 9]>
      <script src=js/html5shiv.js></script>
      <script src=js/respond.min.js></script>
      <![endif]-->
      <link rel=icon href=images/ico/i512.png>
        </head>
   <body>
      <?php include ("header.php") ?>
      <section id=main-slider class=carousel>
         <div class=carousel-inner>
            <div class="item active">
               <div class=container>
                  <div class=carousel-content>
                     <h1>Great Minds Enterprise</h1>
                     <p class=lead>A Forum To Bring The Great Minds Together</p>
                  </div>
               </div>
            </div>
            <div class=item>
               <div class=container>
                  <div class=carousel-content>
                     <h1>Register</h1>
                     <p class=lead>Register to have the access to our Forums</p>
                  </div>
               </div>
            </div>
            <div class=item>
               <div class=container>
                  <div class=carousel-content>
                     <h1>The Team</h1>
                     <p class=lead>A Team of Bright Minds came together to allow ideas to be developed into the real World.</p>
                  </div>
               </div>
            </div>
         </div>
         <a class=prev href=#main-slider data-slide=prev><i class=icon-angle-left></i></a>
         <a class=next href=#main-slider data-slide=next><i class=icon-angle-right></i></a>
      </section>
      <div>
         <div class="container">
            <div class="box">
                <div class="center">
                    <h2>Meet the Team</h2>
                <div class="gap"></div>
                <div id="team-scroller" class="carousel scale">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-2">
                                    
                                </div>
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="image/team/steve.jfif" alt="" ></p>
                                        <h3>Stephen Conyers<small class="designation">Product Manager</small></h3>
                                    </div>
                                </div> 
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="image/team/onur.jpg" alt="" ></p>
                                        <h3>Onur Akbas<small class="designation">Scrum Master</small></h3>
                                    </div>
                                </div>
                            </div>
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="image/team/basil.jfif" alt="" ></p>
                                        <h3>Basil Yip<small class="designation">Staff</small></h3>
                                    </div>
                                </div>   
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="image/team/pasha.jfif" alt="" ></p>
                                        <h3>Pasha Kazmi<small class="designation">Staff</small></h3>
                                    </div>
                                </div>     
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="image/team/jahirul.jfif" alt="" ></p>
                                        <h3>Jahirul Alom<small class="designation">Staff</small></h3>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-2">
                                    
                                </div>
                                    <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="image/team/micheal.jfif" alt="" ></p>
                                        <h3>Michael Ade<small class="designation">Staff</small></h3>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="image/team/moe.jpg" alt="" ></p>
                                        <h3>Mohamed Ahmed<small class="designation">Staff</small></h3>
                                    </div>
                                </div>
                               </div>
                            </div>
                    </div>
                </div><!--/.carousel-->
            </div><!--/.box-->
        </div><!--/.container-->
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
            <div class=col-sm-6>
               &copy; 2018 <a id=hyperlink1 > University Of Greenwich | Website Powered and Designed By Great Minds enterprise</a>
            </div>
         </div>
      </div>
   </footer>