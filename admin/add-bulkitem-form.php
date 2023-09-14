<?php
// Include config file
require_once "php/config.php";
 
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
                    <h2 class="mt-5">Create Bulk Item</h2>
                    <p>Please fill this form and submit to add item record to the database.</p>

                    <form action="addBulkItem.php" method="post" enctype="multipart/form-data">
                      
                        <div class="form-group">
                            <label>Bulk Item Name</label>
                            <input type="text" name="bulkItemName" class="form-control" value="">

                        </div>
                        <div class="form-group">
                            <label>Price per sack:</label>
                            <input type="type" name="bulkItemPrice"  class="form-control" value="">
                
                        </div>
                        <div class="form-group">
                            <label>Quantity Sack:</label> 
                            <input type="number" name="bulkItemQtty" class="form-control"  value="">
                          
                        </div>
        
                        <div class="form-group">
                        <label>Item Description</label>
                            <textarea name="bulkItemDesc"  class="form-control" ></textarea>
                         
                        </div>

                        <div >
                            <label for="itemImg">Upload Image</label>
                            <input type="file" name="bulkItemImg"  id="itemImg" class="form-control"  >
       
                        </div>

                        <br></br>

                        <input type="submit" class="btn btn-primary" value="submit" name="save_item">
                        <a href="add-item-form.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
    </br>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
