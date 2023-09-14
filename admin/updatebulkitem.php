<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
//$itemName = $S = $M = $L  = $itemDesc  =  $itemPrice =   "";
 //$itemName_err = $S_err =$M_err = $L_err = $itemDesc_err= $itemPrice_err  =   "";

 $bulkItemName = $bulkItemPrice = $bulkItemQtty  = $bulkItemDesc  =  "";
 $bulkItemName_err   = $bulkItemPrice_err  = $bulkItemQtty_err   = $bulkItemDesc_err    = "";

 
// Processing form data when form is submitted
if(isset($_POST["bulkItemID"]) && !empty($_POST["bulkItemID"])){
    // Get hidden input value
    $bulkItemID = $_POST["bulkItemID"];
    
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
    

    
    // Check input errors before inserting in database
    if( empty($bulkItemName_err)  && empty($bulkItemPrice_err) && empty($bulkItemQtty_err )&& empty($bulkItemDesc_err )){
        // Prepare an update statement
        $sql = "UPDATE bulkitem SET bulkItemName=?, bulkItemPrice=?, bulkItemQtty=?, bulkItemDesc=? WHERE bulkItemID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sdiss",  $param_bulkItemName , $param_bulkItemPrice , $param_bulkItemQtty , $param_bulkItemDesc , $param_bulkItemID );
            
            // Set parameters
            $param_bulkItemName = $bulkItemName;
            $param_bulkItemPrice = $bulkItemPrice;
            $param_bulkItemQtty = $bulkItemQtty;
            $param_bulkItemDesc = $bulkItemDesc ;
            $param_bulkItemID = $bulkItemID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: view-bulkitem-form.php?bulkItemID=".$bulkItemID);
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["bulkItemID"]) && !empty(trim($_GET["bulkItemID"]))){
        // Get URL parameter
        $bulkItemID =  trim($_GET["bulkItemID"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM bulkitem WHERE bulkItemID = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_bulkItemID);
            
            // Set parameters
            $param_bulkItemID = $bulkItemID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $bulkItemName = $row["bulkItemName"];
                    $bulkItemPrice = $row["bulkItemPrice"];
                    $bulkItemQtty = $row["bulkItemQtty"];
                    $bulkItemDesc = $row["bulkItemDesc"];
            
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: banana.php");
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
        header("location: pishang.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                <a class="btn btn-primary" href="list-bulkitem.php">Back</a>
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the item record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="bulkItemName" class="form-control <?php echo (!empty($bulkItemName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bulkItemName; ?>">
                            <span class="invalid-feedback"><?php echo $bulkItemName_err;?></span>
                        </div>
               
                        <div class="form-group">
                            <label>Price:</label>
                            <input type="text" name="bulkItemPrice" class="form-control <?php echo (!empty($bulkItemPrice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bulkItemPrice; ?>">
                            <span class="invalid-feedback"><?php echo $bulkItemPrice_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantity:</label>
                            <input type="number" name="bulkItemQtty" class="form-control <?php echo (!empty($bulkItemQtty_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bulkItemQtty; ?>">
                            <span class="invalid-feedback"><?php echo $bulkItemQtty_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="bulkItemDesc" class="form-control <?php echo (!empty($bulkItemDesc_err)) ? 'is-invalid' : ''; ?>" rows="4" value="<?php echo $bulkItemDesc; ?>"><?php echo $bulkItemDesc; ?></textarea>
                            <span class="invalid-feedback"><?php echo $bulkItemDesc_err;?></span>
                        </div>

                   
                        <input type="hidden" name="bulkItemID" value="<?php echo $bulkItemID; ?>"/>
                        <input type="submit" class="btn btn-primary"  onclick="myFunction()"value="Update">
                
                        <br> </br>
                
                    </form>

                    
                <script>
                  var form = document.getElementById('f');

                  function myFunction() {

                     alert("Update Succesfully!");

                       }           
                </script>
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>