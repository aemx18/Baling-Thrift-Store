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
     
<!DOCTYPE html>

<style>
  
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
	box-sizing: border-box;
}

body {
background-image: url('img/loginbg.png');
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
	height: 100vh;
	margin: -20px 0 50px;

}

h1 {
	font-weight: bold;
	margin: 0;
}

h2 {
	text-align: center;
}

p {
	font-size: 14px;
	font-weight: 100;
	line-height: 20px;
	letter-spacing: 0.5px;
	margin: 20px 0 30px;
}

span {
	font-size: 12px;
}

a {
	color: #333;
	font-size: 14px;
	text-decoration: none;
	margin: 15px 0;
}

.inp {
	border-radius: 20px;
	border: 1px solid #FF4B2B;
	background-color: #FF4B2B;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}

.inp:active {
	transform: scale(0.95);
}

.inp:focus {
	outline: none;
}

.inp.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}

form {
	background-color: #FFFFFF;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 50px;
	height: 100%;
	text-align: center;
}

input {
	background-color: #eee;
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
}

.container {
	background-color: #fff;
	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	overflow: hidden;
	width: 768px;
	max-width: 100%;
	min-height: 480px;
}

.form-container {
	position: absolute;
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
}

.sign-in-container {
	left: 0;
	width: 50%;
	z-index: 2;
}

.container.right-panel-active .sign-in-container {
	transform: translateX(100%);
}

.sign-up-container {
	left: 0;
	width: 50%;
	opacity: 0;
	z-index: 1;
}

.container.right-panel-active .sign-up-container {
	transform: translateX(100%);
	opacity: 1;
	z-index: 5;
	animation: show 0.6s;
}

@keyframes show {
	0%, 49.99% {
		opacity: 0;
		z-index: 1;
	}
	
	50%, 100% {
		opacity: 1;
		z-index: 5;
	}
}

.overlay-container {
	position: absolute;
	top: 0;
	left: 50%;
	width: 50%;
	height: 100%;
	overflow: hidden;
	transition: transform 0.6s ease-in-out;
	z-index: 100;
}

.container.right-panel-active .overlay-container{
	transform: translateX(-100%);
}

.overlay {
	background: #FF416C;
	background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
	background: linear-gradient(to right, #FF4B2B, #FF416C);
	background-repeat: no-repeat;
	background-size: cover;
	background-position: 0 0;
	color: #FFFFFF;
	position: relative;
	left: -100%;
	height: 100%;
	width: 200%;
  	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
  	transform: translateX(50%);
}

.overlay-panel {
	position: absolute;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 40px;
	text-align: center;
	top: 0;
	height: 100%;
	width: 50%;
	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.overlay-left {
	transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
	transform: translateX(0);
}

.overlay-right {
	right: 0;
	transform: translateX(0);
}

.container.right-panel-active .overlay-right {
	transform: translateX(20%);
}

.social-container {
	margin: 20px 0;
}

.social-container a {
	border: 1px solid #DDDDDD;
	border-radius: 50%;
	display: inline-flex;
	justify-content: center;
	align-items: center;
	margin: 0 5px;
	height: 40px;
	width: 40px;
}

footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
}

footer i {
    color: red;
}

footer a {
    color: #3c97bf;
    text-decoration: none;
}
</style>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Customer | Login & Registration</title>
    
   

  </head>
  

  
  <body> 

    <div class="container" id="container">
      <div class="form-container sign-up-container">

     
      </div>


 <div class="form-container sign-in-container">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <h1>Register </h1>
          <div class="social-container">
      
          </div>
		  <input type="text" id="custEmail"<?php echo (!empty($custName_err)) ? 'is-invalid' : ''; ?> name="custName" value="<?php echo $custName; ?>" placeholder="Customer Name" />
		  <span class="invalid-feedback"><?php echo $custName_err; ?>
          <input type="text" id="custEmail"<?php echo (!empty($custEmail_err)) ? 'is-invalid' : ''; ?> name="custEmail" value="<?php echo $custEmail; ?>" placeholder="Customer Email" />
		  <span class="invalid-feedback"><?php echo $custEmail_err; ?>
		  <input type="password" id="custPass"<?php echo (!empty($custPass_err)) ? 'is-invalid' : ''; ?> name="custPass" value="<?php echo $custPass; ?>" placeholder="Customer Password" />
		  <span class="invalid-feedback"><?php echo $custPass_err; ?>
		  <label>Address:</label> <br>
		  <textarea type="text" id="custAddress"<?php echo (!empty($custAddress_err)) ? 'is-invalid' : ''; ?> name="custAddress" value="<?php echo $custAddress; ?>" placeholder="Address" > </textarea> <br>
		  <span class="invalid-feedback"><?php echo $custAddress_err; ?>
		  <input type="text" id="custPhone"<?php echo (!empty($custPhone_err)) ? 'is-invalid' : ''; ?> name="custPhone" value="<?php echo $custPhone; ?>" placeholder="Customer Phone" />
		  <span class="invalid-feedback"><?php echo $custPhone_err; ?>

          <input class="inp" type="submit" value= "Register"> <br>
		  
    
        </form>
      </div>
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p>To keep connected with us please login with your personal info</p>
            <button class="ghost" id="signIn">Sign In</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1>Hello, Valued Customer!</h1>
            <p>Enter your personal details and start journey with us</p>
          <u> <b> <a class="ghost" href="loginCustomer.php" id="">Has an Account!</a></b></u> <br>

			<div style="border:solid;padding: 7px; ">
			<a style="color: #eee;" href ="../index.html"> Main Page</a>
			</div>
          </div>
        </div>
      </div>
    </div>

  </body>

  <script>
    const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
  </script>

</html>