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
    <meta charset="UTF-8">
    <title>Update Retailer Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
        
         
            
                <div class="col-md-12">
                    <br> </br>
                <a class="btn btn-primary" href="customerHomepage.php">Back</a>
                    <h2 class="mt-5">Update Profile</h2>
                    <p>This form purposes to the customer update their profile details</p>






                    <form action="" method="post">
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
                    <label>Customer Name</label>
                    <input type="text" name="custName" class="form-control" value="<?php echo $row["custName"];?>">
  
                </div>
                <div class="form-group">
                    <label>Customer Email</label>
                    <input type="text" name="custEmail" class="form-control " value="<?php echo $row["custEmail"]; ?>">

                </div>
                <div class="form-group">
                    <label>Customer Address </label> 
                    <input type="text" name="custAddress" class="form-control" value="<?php echo $row["custAddress"]; ?>">
             
                </div>
            
                <div class="form-group">
                    <label>Customer Phone</label>
                    <input type="text" name="custPhone" class="form-control"  value="<?php echo $row["custPhone"]; ?>"
       
                </div>
        

                <br></br>
                <input type="hidden" name="retailerID" value="<?php echo $custID; ?>"/>
                <input type="submit" class="btn btn-primary" onclick="myFunction()" name="submit" value="Submit">

                <script>
var form = document.getElementById('f');

function myFunction() {

    alert("Update Succesful!");

}            </script>
        
               
            </form>
                    
                </div>
                <?php 
                  }
                }
              }
               ?>
            </div>        
        </div>
    </div>
</body>
</html>