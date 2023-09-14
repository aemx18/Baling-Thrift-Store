<!DOCTYPE html>

<?php
// Initialize the session
session_start();

require_once "php/config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: loginCustomer.php"); 
  
    
    exit;
}

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
  // Include config file
  require_once "php/config.php";
  
  // Prepare a select statement
  $sql = "SELECT * FROM `order` WHERE id = ?";
  
  if($stmt = mysqli_prepare($link, $sql)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_id);
      
      // Set parameters
      $param_id = trim($_GET["id"]);
      
      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
          $result = mysqli_stmt_get_result($stmt);
  
          if(mysqli_num_rows($result) == 1){
              /* Fetch result row as an associative array. Since the result set
              contains only one row, we don't need to use while loop */
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              
              // Retrieve individual field value
              $id = $row["id"];
              $name = $row["name"];
              $email = $row["email"];
              $phone= $row["phone"];
              $address = $row["address"];
              $pmode = $row["pmode"];
              $products = $row['products'];
              
              $amount_paid = $row['amount_paid'];
      

              $size = $row["size"];
              $OrderTimeDate = $row['OrderTimeDate'];
          } else{
              // URL doesn't contain valid id parameter. Redirect to error page
              header("location: error.php");
              exit();
          }
          
      } else{
          echo "Oops! Something went wrong. Please try again later.";
      }
  }
   
  // Close statement
  mysqli_stmt_close($stmt);
  
  // Close connection
  mysqli_close($link);
} else{
  // URL doesn't contain id parameter. Redirect to error page
  header("location: error.php");
  exit();
}
?>

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
          
                  <p>Baling <strong>Thrift Store</strong> <span style=" text-transform: lowercase;"><?php echo $_SESSION['custEmail']; ?></span></p>
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
              <li><a href="shop.php">Shop Now! </a></li>
              <li><a href="cart.php" >Cart </a></li>
              <li><a href="list-Order.php">Order </a></li>
              <li><a href="listPayment.php">View Receipt </a></li>
              <li><a href="#">Profile <span class="caret"></span></a>
                <ul class="dropdown-menu">                
                  <li><a href="edit-profile-form.php"> Edit Profile</a></li>
                  <li><a href="cust-view-form.php">View Profile</a></li>
                       

                </ul>

                <li><a href="logout.php">Log out </a></li>
  
          
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
                <div class="col-md-auto">
                    <div class="mt-5 mb-3 clearfix">

      
      

                      
                  <div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Upload Receipt</h1>
					
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : <?php echo $row['products']; ?></h4>
								<h4>Retailer Name :  <?php echo $row['name']; ?></h4>
								<h4>Total Amount Paid : RM<?php echo $row ['amount_paid']?> </h4>
                <h4>Orer ID: <?php echo $row ['id']?> </h4>
								<h4>Payment Mode : <?php echo $row ['pmode']?> 
   
                

                <form action="uploadReceipt.php?ordersID=<?php echo $row["id"]?>" method="post" enctype="multipart/form-data">
                <h4>Upload Receipt : </h4>
   
                <center>  <input name="uploadR" id="uploadR" type="file" value=""></center> 
                <center>  <input name="paymentStatus" id="uploadR" type="hidden" value="pending"></center> 
        
              <br>
              <input type="submit"  class="btn btn-primary" value="submit" name="upload" >
                </form>
<br>
								<a  href="list-order.php"  Value=""> Back </a>
						  </div>

           


                </div>
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