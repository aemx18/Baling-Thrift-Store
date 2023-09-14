<!DOCTYPE html>

<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: retailerHomepage.php");
    exit;
}
 
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
$retailerEmail = $retailerIC = "";
$retailerEmail_err = $retailerIC_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["retailerEmail"]))){
        $retailerEmail = "Please enter email.";
    }  else{
        $retailerEmail = trim($_POST["retailerEmail"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["retailerIC"]))){
        $retailerIC_err = "Please enter your password.";
    } else  if($retailerIC = strlen(trim($_POST["retailerIC"])) < 12)
    $retailerIC_err = "The format of IC is 002233021122";
     else{
        $retailerIC = trim($_POST["retailerIC"]);
    }
    
    // Validate credentials
    if(empty($retailerEmail_err) && empty($retailerIC_err)){
        // Prepare a select statement
        $sql = "SELECT retailerID, retailerEmail, retailerIC FROM retailer WHERE retailerEmail =?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_retailerEmail);

            // Set parameters
            $param_retailerEmail = $retailerEmail;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $retailerID, $retailerEmail, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($retailerIC, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["retailerID"] = $retailerID;
                            $_SESSION["retailerEmail"] = $retailerEmail;                            
                            
                            // Redirect user to welcome page
                            header("location: retailerHomepage.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = " Password is incorrect";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Username doesn't exist";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Baling Thrift Store (BTS) System | Home</title>
  </head>

  <style>
    html {
  height: 100%;
}
body {
  margin:0;
  padding:0;
  font-family: sans-serif;
  background: linear-gradient(#141e30, #243b55);
  background-image: url(img/loginbg.jpg);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}

.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.5);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
}

.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #fff;
  text-align: center;
}

.login-box .user-box {
  position: relative;
}

.login-box .user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid #fff;
  outline: none;
  background: transparent;
}
.login-box .user-box label {
  position: absolute;
  top:0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  transition: .5s;
}

.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #03e9f4;
  font-size: 12px;
}

.login-box form a {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color: #03e9f4;
  font-size: 16px;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  transition: .5s;
  margin-top: 40px;
  letter-spacing: 4px
}

.login-box a:hover {
  background: #03e9f4;
  color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px #03e9f4,
              0 0 25px #03e9f4,
              0 0 50px #03e9f4,
              0 0 100px #03e9f4;
}

.login-box a span {
  position: absolute;
  display: block;
}

.login-box a span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #03e9f4);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }
  50%,100% {
    left: 100%;
  }
}

.login-box a span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #03e9f4);
  animation: btn-anim2 1s linear infinite;
  animation-delay: .25s
}

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }
  50%,100% {
    top: 100%;
  }
}

.login-box a span:nth-child(3) {
  bottom: 0;
  right: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(270deg, transparent, #03e9f4);
  animation: btn-anim3 1s linear infinite;
  animation-delay: .5s
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }
  50%,100% {
    right: 100%;
  }
}

.login-box a span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #03e9f4);
  animation: btn-anim4 1s linear infinite;
  animation-delay: .75s
}

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }
  50%,100% {
    bottom: 100%;
  }
}

    </style>

<body>
<div class="login-box">


  <h2>Login</h2>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="user-box">
      <input type="email" name="retailerEmail" required=""  id="retailerEmail" <?php echo (!empty($retailerEmail_err)) ? 'is-invalid' : ''; ?> value="<?php echo $retailerEmail; ?>">
      <label>Email</label>
      <span style="color:white" class="invalid-feedback"><?php echo $retailerEmail_err; ?>
    </div>
    <div class="user-box">
      <input type="password" name="retailerIC" required="" maxlength="12" id= "retailerIC"<?php echo (!empty($retailerIC_err)) ? 'is-invalid' : ''; ?> value="<?php echo $retailerIC; ?>">
      <label>Password</label>
      <span style="color:white" class="invalid-feedback"><?php echo $retailerIC_err; ?>
    </div>
   
    <input type="submit" value= "Login"> <br>
   
    
    <center> <b style="color:white"> <span  class="invalid-feedback"><?php echo $login_err; ?></span> </center> </b>
    <a class="" href ="../index.html"> Main Page
  </form>
</div>
    
  </body>
</html>