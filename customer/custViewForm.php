
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
                <a href="customerHomepage.php">
                  <span class=""></span>
                  <p >Baling <strong>Thrift Store</strong> <span style=" text-transform: lowercase;"><?php echo $_SESSION['custEmail']; ?></span></p>
            
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
            <li><a href="customerHomepage.php">Home</a></li>
              <li><a href="#">Order </a></li>
              <li><a href="cart.php" >Cart </a></li>
              <li><a href="#">Payment </a></li>
              <li><a href="#">Profile <span class="caret"></span></a>
                <ul class="dropdown-menu">                
                  <li><a href="#"> Edit Profile</a></li>
                  <li><a href="custViewForm.php">View Profile</a></li>
                       
                </ul>
              </li>

        
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
                    $currentCustomer = $_SESSION['custEmail'];
    $sql = "SELECT custName,custEmail,custAddress,custPhone,created_by FROM customer WHERE custEmail ='$currentCustomer'";

  $result =   mysqli_query($link,$sql );
  if($result){
    if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_array($result)){
        
        //print_r($row);
  ?>

                    <div class="form-group">
                
                    <div class="form-group">
                        <div class="bingkai">
                        <label>Customer Name:</label>
                        <p><b><?php echo $row["custName"]; ?></b></p>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="bingkai">
                        <label>Customer Email:</label>
                        <p><b><?php echo $row["custEmail"]; ?></b></p>
                    </div>
                    </div>
                    <div class="form-group">
                          <div class="bingkai">
                        <label>Customer Address:</label>
                        <p><b><?php echo $row["custAddress"]; ?></b></p>
                          </div>
                    </div>
                    <div class="form-group">
                    <div class="bingkai">
                        <label>Customer Phone:</label>
                        <p><b><?php echo $row["custPhone"]; ?></b></p>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="bingkai">
                        <label>Register Time:</label>
                        <p><b><?php echo $row["created_by"]; ?></b></p>
                    </div>
                    </div>
                    <p><a href="customerHomepage.php" class="btn btn-primary">Back</a></p>
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