<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
$itemName = $S = $M = $L  = $itemDesc  =  $itemPrice =   "";
 $itemName_err = $S_err =$M_err = $L_err = $itemDesc_err= $itemPrice_err  =   "";
 
// Processing form data when form is submitted
if(isset($_POST["itemID"]) && !empty($_POST["itemID"])){
    // Get hidden input value
    $itemID = $_POST["itemID"];
    
    // Validate item name
    $input_itemName = trim($_POST["itemName"]);
    if(empty($input_itemName)){
        $itemName_err = "Please enter an item name.";
    }  else{
        $itemName = $input_itemName;
    }  
    
    // Validate S
    $input_S = trim($_POST["S"]);
    if(empty($input_S)){
        $S_err = "Please enter the size for S.";     
    }  else{
        $S = (int) $input_S;
        
    }
 
    // Validate M
    $input_M = trim($_POST["M"]);
    if(empty($input_M)){
        $M_err = "Please enter the size for M.";     
    }  else{
        $M = (int) $input_M;
    }

        // Validate L
        $input_L = trim($_POST["L"]);
        if(empty($input_M)){
            $L_err = "Please enter the size for L.";     
        }  else{
            $L = (int) $input_L;
        }

        
       // Validate desc
       $input_itemDesc= trim($_POST["itemDesc"]);
       if(empty($input_itemDesc)){
           $itemDesc_err = "Insert long text.";     
       } else{
           $itemDesc = $input_itemDesc;
       }    
        //validte price
       $input_itemPrice= trim($_POST["itemPrice"]);
       if(empty($input_itemPrice)){
           $itemPrice_err = "Use Decimal Number.";     
       } else{
           $itemPrice = $input_itemPrice;
       }    
   
    
    // Check input errors before inserting in database
    if( empty($itemName_err) && empty($S_err) && empty($M_err) && empty($L_err ) && empty($itemDesc_err ) && empty($itemPrice_err )){
        // Prepare an update statement
        $sql = "UPDATE item SET itemName=?, S=?, M=?, L=?, itemDesc=?, itemPrice=? WHERE itemID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siiisds",  $param_itemName , $param_S , $param_M , $param_L , $param_itemDesc , $param_itemPrice , $param_itemID );
            
            // Set parameters
            $param_itemName = $itemName;
            $param_S = $S;
            $param_M = $M;
            $param_L = $L;
            $param_itemDesc = $itemDesc;
            $param_itemPrice = $itemPrice;
            $param_itemID = $itemID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: view-item-form.php?itemID=".$itemID);
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
    if(isset($_GET["itemID"]) && !empty(trim($_GET["itemID"]))){
        // Get URL parameter
        $itemID =  trim($_GET["itemID"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM item WHERE itemID = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_itemID);
            
            // Set parameters
            $param_itemID = $itemID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $itemName = $row["itemName"];
                    $S = $row["S"];
                    $M = $row["M"];
                    $L = $row["L"];
                    $itemDesc = $row["itemDesc"];
                    $itemPrice = $row["itemPrice"];
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
                <a class="btn btn-primary" href="list-item.php">Back</a>
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the item record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="itemName" class="form-control <?php echo (!empty($itemName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemName; ?>">
                            <span class="invalid-feedback"><?php echo $itemName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Size: S</label>
                            <input type="number" name="S" class="form-control <?php echo (!empty($S_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $S; ?>">
                            <span class="invalid-feedback"><?php echo $S_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Size: M</label>
                            <input type="number" name="M" class="form-control <?php echo (!empty($M_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $M; ?>">
                            <span class="invalid-feedback"><?php echo $M_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Size: L</label>
                            <input type="number" name="L" class="form-control <?php echo (!empty($L_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $L; ?>">
                            <span class="invalid-feedback"><?php echo $L_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="itemDesc" class="form-control <?php echo (!empty($itemDesc_err)) ? 'is-invalid' : ''; ?>" rows="4" valie="<?php echo $itemDesc; ?>"><?php echo $itemDesc; ?></textarea>
                            <span class="invalid-feedback"><?php echo $itemDesc_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Item Price</label>
                            <input type="text" name="itemPrice" class="form-control <?php echo (!empty($itemPrice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemPrice; ?>">
                            <span class="invalid-feedback"><?php echo $itemPrice_err;?></span>
                        </div>
                        <input type="hidden" name="itemID" value="<?php echo $itemID; ?>"/>
                        <input type="submit" class="btn btn-primary" onclick="myFunction()" value="Submit">
                
                        <br> </br>
                
                    </form>

                    
                <script>
                    var form = document.getElementById('f');

                    function myFunction() {

                    alert("Update Succesful!");

                        }           
                 </script>
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>