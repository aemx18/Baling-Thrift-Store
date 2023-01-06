<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
$itemID = $itemName = $S =$M= $L = $itemDesc = $itemPrice = $itemDisc = $itemDate = $itemImage =  "";
$itemID_err = $itemName_err = $S_err =$M_err = $L_err = $itemDesc_err = $itemPrice_err = $itemDisc_err = $itemDate_err = $itemImage_err = "";

 
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
        $S_err = "Size.";     
    } else{
        $S = $input_S;
    }    
    
    // Validate M
    $input_M = trim($_POST["M"]);
    if(empty($input_M)){
        $M_err = "Size.";     
    } else{
        $M = $input_M;
    }    

    // Validate L
    $input_L = trim($_POST["L"]);
    if(empty($input_L)){
        $L_err = "Size.";     
    } else{
        $L = $input_L;
    }    

    // Validate ITEM DESCRIPTION
    $input_itemDesc = trim($_POST["itemDesc"]);
    if(empty($input_itemDesc)){
        $itemDesc_err = "item description.";     
    } else{
        $itemDesc = $input_itemDesc;
    }    
    
    // Validate Item price
    $input_itemPrice = trim($_POST["itemPrice"]);
    if(empty($input_itemPrice)){
        $itemPrice_err = "Size.";     
    } else{
        $itemPrice = $input_itemPrice;
    }    
    
    // Validate Item discount
    $input_itemDisc = trim($_POST["itemDisc"]);
    if(empty($input_itemDisc)){
        $itemDisc_err = "Disount for item.";     
    } else{
        $itemDisc = $input_itemDisc;
    }
    
    $input_itemDate = trim($_POST["itemDate"]);
    if(empty($input_itemDate)){
        $itemDate_err = "Disount for item.";     
    } else{
        $itemDate= $input_itemDate;
    }
    
    
    $input_itemImage = trim($_POST["itemImage"]);
    if(empty($input_itemImage)){
        $itemImage_err = "Disount for item.";     
    } else{
        $itemImage= $input_itemImage;
    }
    
    
    
    
    
  
    // Check input errors before inserting in database
    if(empty($itemID_err) && empty($itemName) && empty($S) && empty($M) && empty($L)
     && empty($itemDesc) && empty($itemPrice) && empty($itemDisc) && empty($itemDate) && empty($itemImage) ){
        // Prepare an insert statement
        $sql = "INSERT INTO item (itemID, itemName, S, M, L, itemDesc, itemPrice, itemDisc, itemDate, itemImage) 
        VALUES (?, ?, ? , ? , ? , ?, ? , ? , ? , ? )";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_itemID,  $param_itemName , $param_S, $param_M , $param_L , 
            $param_itemDesc  , $param_itemPrice  , $param_itemDisc  , $param_itemDate  , $param_itemImage );
            
            // Set parameters
            $param_itemID = $itemID;
            $param_itemName = $itemName;
            $param_S = $S;
            $param_M = $S;
            $param_l = $L;
            $param_itemDesc = $itemDesc;
            $param_itemPrice = $itemPrice;
            $param_itemDisc = $itemDisc;
            $param_itemDate = $itemDate;
            $param_itemImage = $itemImage;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: view-item.php");
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
                <a href="adminHomepage.php">Home</a>
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
                            <label>Size S</label>
                            <input type="number" name="S" class="form-control <?php echo (!empty($S_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $S; ?>">
                            <span class="invalid-feedback"><?php echo $S_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Size M</label> 
                            <input type="number" name="M" class="form-control <?php echo (!empty($M_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $M; ?>">
                            <span class="invalid-feedback"><?php echo $M_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Size L</label>
                            <input type="number" name="L" class="form-control <?php echo (!empty($L_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $L; ?>">
                            <span class="invalid-feedback"><?php echo $S_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Item Description</label>
                            <input type="text" name="itemDesc" class="form-control <?php echo (!empty($itemDesc_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemDesc; ?>">
                            <span class="invalid-feedback"><?php echo $itemDesc_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Item Price</label>
                            <input type="text" name="itemPrice" class="form-control <?php echo (!empty($itemPrice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemPrice; ?>">
                            <span class="invalid-feedback"><?php echo $itemPrice_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Item Discount</label>
                            <input type="text" name="itemDisc" class="form-control <?php echo (!empty($itemDisc_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemDisc; ?>">
                            <span class="invalid-feedback"><?php echo $itemDisc_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Item Date</label>
                            <input type="date" name="itemDate" class="form-control <?php echo (!empty($itemDate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemDate; ?>">
                            <span class="invalid-feedback"><?php echo $itemDate_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Item Image</label>
                            <input type="text" name="itemImage" class="form-control <?php echo (!empty($itemImage_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemImage; ?>">
                            <span class="invalid-feedback"><?php echo $itemImage_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="add-item.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>