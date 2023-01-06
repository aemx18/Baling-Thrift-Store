<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$custName = $custPass = $custEmail = $custAddress = $custPhone ="";
$custName_err = $custPass_err = $custEmail_err = $custAddress_err = $custPhone_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate name
    $input_custName = trim($_POST["custName"]);
    if(empty($input_custName)){
        $custName_err = "Please enter your full name.";
    } else{
        $custName = $input_custName;
    }
    
    // Validate Password
    $uppercase = preg_match('@[A-Z]@', $custPass);
    $lowercase = preg_match('@[a-z]@', $custPass);
    $number    = preg_match('@[0-9]@', $custPass);
    $specialChars = preg_match('@[^\w]@', $custPass);

    $input_custPass = trim($_POST["custPass"]);
    if(empty($input_custPass)){
        $custPass_err = "Please enter an address.";     
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
        echo 'Password should be at least 8 characters in length and should include at least one 
        upper case letter, one number, and one special character.';
    }else{
        $custPass = $input_custPass;
        echo 'Strong password.';
    }


    // Validate Email
    $input_custEmail= trim($_POST["custEmail"]);
    if(empty($input_custEmail)){
        $custEmail_err = "Please enter your full name.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){  
        $custEmail_err = "Only letters and white space allowed";
    } else{
        $custEmail = $input_custEmail;
    }
 


    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
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