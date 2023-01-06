<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
$bulkItemID = $bulkItemName  = $bulkItemPrice = $bulkItemQtty  = $bulkItemDesc  =  "";
$bulkItemID_err = $bulkItemName_err   = $bulkItemPrice_err  = $bulkItemQtty_err   = $bulkItemDesc_err    = "";




 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Validate ID
    $input_bulkItemID = trim($_POST["bulkItemID"]);
    if(empty($input_bulkItemID)){
        $bulkItemID_err = "Please enter a ID.";
    } else{
        $bulkItemID = $input_bulkItemID;
    }
    
    // Validate ItemN name
    $input_bulkItemName = trim($_POST["bulkItemName"]);
    if(empty($input_bulkItemName)){
        $bulkItemName_err = "Please enter an Item Name .";     
    } else{
        $bulkItemName  = $input_bulkItemName ;
    }
    

    
    // Validate price
    $input_bulkItemPrice = trim($_POST["bulkItemPrice"]);
    if(empty($input_bulkItemPrice)){
        $bulkItemPrice_err = "Insert Price.";     
    } else{
        $bulkItemPrice = $input_bulkItemPrice;
    }    

    // Validate Quantity
    $input_bulkItemQtty = trim($_POST["bulkItemQtty"]); 
    if(empty($input_bulkItemQtty)){
        $bulkItemQtty_err = "Insert Item Quantity.";     
    } else{
        $bulkItemQtty = (int)  $input_bulkItemQtty;
    }    
        // Validate Description
    $input_bulkItemDesc= trim($_POST["bulkItemDesc"]); 
    if(empty($input_bulkItemDesc)){
        $bulkItemDesc_err = "Write description about this item.";     
    } else{
        $bulkItemDesc =   $input_bulkItemDesc;
    }     
    

    


    

    
    //bulkItemID	bulkItemName	bulkItemGrade	bulkItemPrice	bulkItemQtty	bulkItemDesc	adminID	
    
  
    // Check input errors before inserting in database
    if(empty($bulkItemID_err) && empty($bulkItemName_err) && empty($bulkItemPrice_err) && empty($bulkItemQtty_err) && empty($bulkItemDesc_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO bulkitem (bulkItemID, bulkItemName, bulkItemPrice, bulkItemQtty, bulkItemDesc) 
        VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssis", $param_bulkItemID,  $param_bulkItemName , $param_bulkItemPrice , $param_bulkItemQtty
            , $param_bulkItemDesc);
            
            // Set parameters
            $param_bulkItemID = $bulkItemID;
            $param_bulkItemName = $bulkItemName;
            $param_bulkItemPrice = $bulkItemPrice;
            $param_bulkItemQtty = $bulkItemQtty;
            $param_bulkItemDesc = $bulkItemDesc;
    
   
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: list-bulkitem.php");
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
                <a class="btn btn-primary" href="list-bulkItem.php">Back</a>
                    <h2 class="mt-5">Create Item</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Item ID</label>
                            <input type="text" name="bulkItemID" class="form-control <?php echo (!empty($bulkItemID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bulkItemID; ?>">
                            <span class="invalid-feedback"><?php echo $itemID_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" name="bulkItemName" class="form-control <?php echo (!empty($bulkItemName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bulkItemName; ?>">
                            <span class="invalid-feedback"><?php echo $bulkItemName_err;?></span>
                        </div>
                   
                        <div class="form-group">
                            <label>Price</label> 
                            <input type="text" name="bulkItemPrice" class="form-control <?php echo (!empty($bulkItemPrice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bulkItemPrice; ?>">
                            <span class="invalid-feedback"><?php echo $bulkItemPrice_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantity Bulk</label>
                            <input type="number" name="bulkItemQtty" class="form-control <?php echo (!empty($bulkItemQtty_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bulkItemQtty; ?>">
                            <span class="invalid-feedback"><?php echo $bulkItemQtty_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="bulkItemDesc" class="form-control <?php echo (!empty($bulkItemDesc_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bulkItemDesc; ?>">
                            <span class="invalid-feedback"><?php echo $bulkItemDesc_err;?></span>
                        </div>

                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="add-bulkItem.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
    </br>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>