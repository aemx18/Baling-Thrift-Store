<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
$itemID = $itemName = $S = $M = $L  = $itemDesc = $itemPrice = "";
$itemID_err = $itemName_err = $S_err =$M_err = $L_err  =  $itemDesc_err= $itemPrice_err ="";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Validate ID
    $input_itemID = trim($_POST["itemID"]);
    if(empty($input_itemID)){
        $itemID_err = "Please enter a ID.";
    } else{
        $itemID = $input_itemID;
    }
    
    // Validate ItemN name
    $input_itemName = trim($_POST["itemName"]);
    if(empty($input_itemName)){
        $itemName_err = "Please enter an Item Name .";     
    } else{
        $itemName  = $input_itemName ;
    }
    
    // Validate S
    $input_S = trim($_POST["S"]);
    if(empty($input_S)){
        $S_err = "PLease insert the quantity.";     
    } else{
      // $int_value = (int) $string;
        $S = (int) $input_S;
    }    
    
    // Validate M
    $input_M = trim($_POST["M"]);
    if(empty($input_M)){
        $M_err = "PLease insert the quantity.";     
    } else{
        $M =(int)  $input_M;
    }    

    // Validate L
    $input_L = trim($_POST["L"]); 
    if(empty($input_L)){
        $L_err = "PLease insert the quantity.";     
    } else{
        $L = (int)  $input_L;
    }    

       // Validate desc
       $input_itemDesc= trim($_POST["itemDesc"]);
       if(empty($input_itemDesc)){
           $itemDesc_err = "PLease insert the description about this item.";     
       } else{
           $itemDesc = $input_itemDesc;
       }    
        //validte price
       $input_itemPrice= trim($_POST["itemPrice"]);
       if(empty($input_itemPrice)){
           $itemPrice_err = "PLease insert the price per pcs";     
       } 
       else{
           $itemPrice =(float) $input_itemPrice;
       }    
   
    
       var_dump($itemID,$itemName, $S,$M,$L,$itemDesc,$itemPrice);
    
  
    // Check input errors before inserting in database
    if(empty($itemID_err) && empty($itemName_err) && empty($S_err) && empty($M_err) && empty($L_err ) && empty($itemDesc_err ) && empty($itemPrice_err )){
        // Prepare an insert statement
        $sql = "INSERT INTO item (itemID, itemName, S, M, L, itemDesc, itemPrice) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiiisd", $param_itemID,  $param_itemName , $param_S, $param_M , $param_L , $param_itemDesc,$param_itemPrice);
            
            // Set parameters
            $param_itemID = $itemID;
            $param_itemName = $itemName;
            $param_S = $S;
            $param_M = $M;
            $param_L = $L;
            $param_itemDesc = $itemDesc;
            $param_itemPrice = $itemPrice;
   
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: list-item.php");
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
                <a class="btn btn-primary" href="list-item.php">Back</a>
                    <h2 class="mt-5">Create Item</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Item ID</label>
                            <input type="text" name="itemID" class="form-control <?php echo (!empty($itemID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemID; ?>">
                            <span class="invalid-feedback"><?php echo $itemID_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" name="itemName" class="form-control <?php echo (!empty($itemName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemName; ?>">
                            <span class="invalid-feedback"><?php echo $itemName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantity of Size S</label>
                            <input type="number" name="S" class="form-control <?php echo (!empty($S_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $S; ?>">
                            <span class="invalid-feedback"><?php echo $S_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantity of Size M</label> 
                            <input type="number" name="M" class="form-control <?php echo (!empty($M_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $M; ?>">
                            <span class="invalid-feedback"><?php echo $M_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantity of Size L</label>
                            <input type="number" name="L" class="form-control <?php echo (!empty($L_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $L; ?>">
                            <span class="invalid-feedback"><?php echo $L_err;?></span>
                        </div>
                        <div class="form-group">
                        <label>Item Description</label>
                            <textarea name="itemDesc" class="form-control <?php echo (!empty($itemDesc_err)) ? 'is-invalid' : ''; ?>"><?php echo $itemDesc; ?></textarea>
                            <span class="invalid-feedback"><?php echo $itemDesc_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Item Price</label>
                            <input type="text" name="itemPrice" class="form-control <?php echo (!empty($itemPrice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemPrice; ?>">
                            <span class="invalid-feedback"><?php echo $itemPrice_err;?></span>
                        </div>

                        <br></br>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="add-item.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
    </br>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
