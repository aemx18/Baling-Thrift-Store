<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
$custName =$custEmail  = $custPass = $custAddress = $custPhone ="";
$custName_err = $custEmail_err = $custPass_err = $custAddress_err = $custPhone_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate name
    $input_custName = trim($_POST["custName"]);
    if(empty($input_custName)){
        $custName_err = "Please enter your full name.";
    } else{
        $custName = $input_custName;
    }


        // Validate Email
        $input_custEmail= trim($_POST["custEmail"]);
        if(empty($input_custEmail)){
            $custEmail_err = "Please enter your email.";
        }   else{
            $custEmail = $input_custEmail;
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


	   var_dump($custName,$custEmail,$custPass,$custAddress,$custPhone);


    // Check input errors before inserting in database
    if(empty($custName_err) && empty($custEmail_err) && empty($custPass_err)
    && empty($custAddress_err)&& empty($custPhone_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO customer (custName,custEmail, custPass,custAddress,custPhone) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_custName, $param_custEmail,$param_custPass
             ,$param_custAddress,$param_custPhone);
            
            // Set parameters
          $param_custName = $custName;
          $param_custEmail =$custEmail;
          $param_custPass =password_hash($custPass, PASSWORD_DEFAULT);
          $param_custAddress = $custAddress;
          $param_custPhone = $custPhone;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: loginCustomer.php");
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