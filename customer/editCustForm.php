<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values

$custName =$custEmail  = $custPass = $custAddress = $custPhone ="";
$custName_err = $custEmail_err = $custPass_err = $custAddress_err = $custPhone_err ="";
 
// Processing form data when form is submitted
if(isset($_POST["custID"]) && !empty($_POST["custID"])){
    // Get hidden input value
    $retailerID = $_POST["retailerID"];
    
  // Validate name
  $input_custName = trim($_POST["custName"]);
  if(empty($input_custName)){
      $custName_err = "Please enter your full name.";
  } else{
      $custName = $input_custName;
  }


      // Validate Email
      if (empty($_POST["custEmail"])) {
          $custEmail_err = "Email is required";
        } else {
          $custEmail = trim($_POST["custEmail"]);
          // check if e-mail address is well-formed
          if (!filter_var($custEmail, FILTER_VALIDATE_EMAIL)) {
            $custEmail_err = "Invalid email format";
          } else {
              // Prepare a select statement
              $sql = "SELECT custID FROM customer WHERE custEmail = ?";
              
              if($stmt = mysqli_prepare($link, $sql)){
                  // Bind variables to the prepared statement as parameters
                  mysqli_stmt_bind_param($stmt, "s", $param_custEmail);
                  
                  // Set parameters
                  $param_custEmail = trim($_POST["custEmail"]);
                  
                  // Attempt to execute the prepared statement
                  if(mysqli_stmt_execute($stmt)){
                      /* store result */
                      mysqli_stmt_store_result($stmt);
                      
                      if(mysqli_stmt_num_rows($stmt) == 1){
                          $custEmail_err = "This email is already taken.";
                      } else{
                          $custEmail = trim($_POST["custEmail"]);
                      }
                  } else{
                      echo "Oops! Something went wrong. Please try again later.";
                  }
      
                  // Close statement
                  mysqli_stmt_close($stmt);
              }
          }
        } 
  
  // Validate Password


  $input_custPass= trim($_POST["custPass"]);
  if(empty($input_custPass)){
      $custPass_err = "Please enter your password.";
  } else{
      $custPass = $input_custPass;
  }



     // Validate Address
     $input_custAddress= trim($_POST["custAddress"]);
     if(empty($input_custAddress)){
         $custAddress_err = "Please enter your address.";
     } else{
         $custAddress = $input_custAddress;
     }

     $input_custPhone= trim($_POST["custPhone"]);
     if(empty($input_custPhone)){
         $custPhone_err = "Please enter your Phone Number.";
     } else{
         $custPhone= $input_custPhone;
     }
    
    
    // Check input errors before inserting in database
    if(empty($custName_err) && empty($custEmail_err) && empty($custPass_err)
    && empty($custAddress_err)&& empty($custPhone_err)){
        // Prepare an update statement
        $sql = "UPDATE retailer SET retailerName=?, retailerEmail=?, retailerIC=?, retailerAddress=?, retailerPhone=? WHERE retailerID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi",  $param_custName , $param_custEmail , $param_custPass, $param_cusAddress , $param_cusAPhone, $param_retailerID );
            
            // Set parameters
            $param_custName = $custName;
            $param_custEmail =$custEmail;
            $param_custPass =password_hash($custPass, PASSWORD_DEFAULT);
            $param_custAddress = $custAddress;
            $param_custPhone = $custPhone;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
             
                header("location: update-customer.php?custID=".$custID);
              
          
                exit();
              ;
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["custID"]) && !empty(trim($_GET["custID"]))){
        // Get URL parameter
        $custID =  trim($_GET["custID"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM customer WHERE custID = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_custID);
            
            // Set parameters
            $param_custID = $custID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $custName = $row["custName"];
                    $custEmail = $row["custEmail"];
                    $custPass = $row["custPass"];
                    $custAddress = $row["custAddress"];
                    $custPhone = $row["custPhone"];
            
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
        }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
                <a class="btn btn-primary" href="list-retailer.php">Back</a>
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the item record.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
                <div class="form-group">
                    <label>Retailer Name</label>
                    <input type="text" name="retailerName" class="form-control <?php echo (!empty($retailerName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $retailerName; ?>">
                    <span class="invalid-feedback"><?php echo $retailerName_err;?></span>
                </div>
                <div class="form-group">
                    <label>Retailer Email</label>
                    <input type="text" name="retailerEmail" class="form-control <?php echo (!empty($retailerEmail_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $retailerEmail; ?>">
                    <span class="invalid-feedback"><?php echo $retailerEmail_err;?></span>
                </div>
                <div class="form-group">
                    <label>Retailer IC</label> 
                    <input type="text" name="retailerIC" class="form-control <?php echo (!empty($retailerIC_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $retailerIC; ?>">
                    <span class="invalid-feedback"><?php echo $retailerIC_err;?></span>
                </div>
                <div class="form-group">
                <label>Retailer Address </label>
                    <textarea name="retailerAddress" class="form-control <?php echo (!empty($retailerAddress_err)) ? 'is-invalid' : ''; ?>"><?php echo $retailerAddress; ?></textarea>
                    <span class="invalid-feedback"><?php echo $retailerAddress_err;?></span>
                </div>
                <div class="form-group">
                    <label>Retailer Phone</label>
                    <input type="text" name="retailerPhone" class="form-control <?php echo (!empty($retailerPhone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $retailerPhone; ?>">
                    <span class="invalid-feedback"><?php echo $retailerPhone_err;?></span>
                </div>
        

                <br></br>
                <input type="hidden" name="retailerID" value="<?php echo $retailerID; ?>"/>
                <input type="submit" class="btn btn-primary" onclick="myFunction()"  value="Submit">

                <script>
var form = document.getElementById('f');

function myFunction() {

    alert("Update Succesful!");

}            </script>
        
               
            </form>
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>