
<?php

session_start();
require_once "php/config.php";

// Check existence of id parameter before processing further
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    // Include config file



    
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' /> 
    <title>Baling Thrift Store (BTS) System | Home</title>
    
    <!-- Font awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="css/jquery.simpleLens.css">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="css/theme-color/default-theme.css" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="css/style.css" rel="stylesheet">    

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  

  </head>

  <style> 
   .bingkai {
    border-style: double;
    padding: 5px;
    height: 80px;
    width: 700px;

  };
  
</style>

  <body> 
   <!-- wpf loader Two -->

    <!-- / wpf loader Two -->       
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
             

        
            
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <a href="index.html"><img style="width:60px;height:60px;" src="img/lgo.png" alt="logo img"></a>
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="retailerHomepage.php">
                  <span class=""></span>
                  <p >Baling <strong>Thrift Store</strong> <span style=" text-transform: lowercase;"><?php echo $_SESSION['retailerEmail']; ?></span></p>
            
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
         
                    
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
            <li><a href="retailerHomepage.php">Home</a></li>
              <li><a href="shop.php">Shop Now! </a></li>
              <li><a href="list-bulk-order.php">Order </a></li>
              <li><a href="cart.php">Cart </a></li>
              <li><a href="listPayment.php">View Receipt </a></li>
              <li><a href="profile-detail.php">View Profile</span></a></li>


        
              <li><a href="logout.php">Log Out</a></li>
          
          
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>
  <!-- / menu -->

  
  <!-- Latest Blog -->
  <section id="aa-latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-latest-blog-area">
     
            <div class="row">
            
     
    <div class="main-block">
   
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Profile</h1>
                    <?php
                    $currentRetailer = $_SESSION['retailerEmail'];
    $sql = "SELECT * FROM retailer WHERE retailerEmail ='$currentRetailer'";

  $result =   mysqli_query($link,$sql );
  if($result){
    if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_array($result)){
        
        //print_r($row);
  ?>

                    <div class="form-group">
                
                    <div class="form-group">
                        <div class="bingkai">
                        <label>Retailer Name:</label>
                        <p><b><?php echo $row["retailerName"]; ?></b></p>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="bingkai">
                        <label>Retailer Email:</label>
                        <p><b><?php echo $row["retailerEmail"]; ?></b></p>
                    </div>
                    </div>
                    <div class="form-group">
                  
                    </div>
                    <div class="form-group">
                          <div class="bingkai">
                        <label>Retailer Address:</label>
                        <p><b><?php echo $row["retailerAddress"]; ?></b></p>
                          </div>
                    </div>
                    <div class="form-group">
                    <div class="bingkai">
                        <label>Retailer Phone:</label>
                        <p><b><?php echo $row["retailerPhone"]; ?></b></p>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="bingkai">
                        <label>Register Time:</label>
                        <p><b><?php echo $row["created_by"]; ?></b></p>
                    </div>
                    </div>
                    <p><a href="retailerHomepage.php" class="btn btn-primary">Back</a></p>
               </div>
               <?php 
                  }
                }
              }
               ?>
            </div>        
        </div>
    </div>


    </div>
            </div>
          </div>
        </div>    
      </div>
    </div>
  </section>
  <!-- / Latest Blog -->


  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.js"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="js/jquery.smartmenus.js"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>  
  <!-- To Slider JS -->
  <script src="js/sequence.js"></script>
  <script src="js/sequence-theme.modern-slide-in.js"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="js/jquery.simpleGallery.js"></script>
  <script type="text/javascript" src="js/jquery.simpleLens.js"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="js/slick.js"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="js/nouislider.js"></script>
  <!-- Custom js -->
  <script src="js/custom.js"></script> 

  </body>
</html>