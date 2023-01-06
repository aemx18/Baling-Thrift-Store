<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
 $retailerName = $retailerEmail= $retailerIC = $retailerAddress  = $retailerPhone = "";
 $retailerName_err = $retailerEmail_err = $retailerIC_err = $retailerAddress_err  = $retailerPhone_err= "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    
    // Validate retailer name
    $input_retailerName = trim($_POST["retailerName"]);
    if(empty($input_retailerName)){
        $retailerName_err = "Please enter retailer Full Name .";     
    } else{
        $retailerName  = $input_retailerName ;
    }
    
    // Validate retailer Email

    if (empty($_POST["retailerEmail"])) {
        $retailerEmail_err = "Email is required";
      } else {
        $retailerEmail = trim($_POST["retailerEmail"]);
        // check if e-mail address is well-formed
        if (!filter_var($retailerEmail, FILTER_VALIDATE_EMAIL)) {
          $retailerEmail_err = "Invalid email format";
        } else {
            // Prepare a select statement
            $sql = "SELECT retailerID FROM retailer WHERE retailerEmail = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_retailerEmail);
                
                // Set parameters
                $param_retailerEmail = trim($_POST["retailerEmail"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $retailerEmail_err = "This email is already taken.";
                    } else{
                        $retailerEmail = trim($_POST["retailerEmail"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
      } 

         // Validate retailer IC
         $input_retailerIC = trim($_POST["retailerIC"]);
    if (empty($_POST["retailerIC"])) {
        $retailerIC_err = "Please enter an IC Number";
      } else if($retailerIC = strlen(trim($_POST["retailerIC"]))<12) {
        $retailerIC_err = "The format of IC is 002233021122";
      } else {
        $retailerIC  = $input_retailerIC ;
      }
      

    // Validate retaier Address
    $input_retailerAddress = trim($_POST["retailerAddress"]); 
    if(empty($input_retailerAddress)){
        $retailerAddress_err = "PLease enter an address.";     
    } else{
        $retailerAddress  =  $input_retailerAddress ;
    }    

       // Validate retailer Phone
       $input_retailerPhone= trim($_POST["retailerPhone"]);
       if(empty($input_retailerPhone)){
           $retailerPhone_err = "Enter phone number.";     
       } else{
           $retailerPhone =  $input_retailerPhone;
       }    
    
    
       var_dump($retailerName,$retailerEmail,$retailerIC,$retailerPhone, $retailerAddress,$retailerPhone);

  
    // Check input errors before inserting in database
    if(empty($retailerName_err) && empty($retailerEmail_err) && empty($retailerIC_err) && empty($retailerAddress_err ) && empty($retailerPhone_err ) ){
        // Prepare an insert statement
    
        $sql = "INSERT INTO retailer (retailerName, retailerEmail, retailerIC, retailerAddress, retailerPhone) 
        VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_retailerName,  $param_retailerEmail , $param_retailerIC, $param_retailerAddress , $param_retailerPhone);
            
            // Set parameters
            $param_retailerName = $retailerName;
            $param_retailerEmail = $retailerEmail;
            $param_retailerIC = password_hash($retailerIC, PASSWORD_DEFAULT);
            $param_retailerAddress = $retailerAddress;
            $param_retailerPhone = $retailerPhone;
  
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: list-retailer.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                  <br>
                <a class="btn btn-primary" href="list-retailer.php">Back</a>
                    <h2 class="mt-5">Register Retailer</h2>
                    <p>Please fill this form to register retailer record to the database.</p>
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

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="add-retailer.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
    </br>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
