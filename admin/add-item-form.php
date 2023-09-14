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
                    <h2 class="mt-5">Create Item</h2>
                    <p>Please fill this form and submit to add item record to the database.</p>

                    <form action="addItem.php" method="post" enctype="multipart/form-data">
                      
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" name="itemName" class="form-control" value="">

                        </div>
                        <div class="form-group">
                            <label>Quantity of Size S</label>
                            <input type="number" name="S"  class="form-control" value="">
                
                        </div>
                        <div class="form-group">
                            <label>Quantity of Size M</label> 
                            <input type="number" name="M" class="form-control"  value="">
                          
                        </div>
                        <div class="form-group">
                            <label>Quantity of Size L</label>
                            <input type="number" name="L"  class="form-control"  value="">
                       
                        </div>
                        <div class="form-group">
                        <label>Item Description</label>
                            <textarea name="itemDesc"  class="form-control" ></textarea>
                         
                        </div>

                        <div class="form-group">
                            <label>Item Price</label>
                            <input type="text" name="itemPrice"  class="form-control"  >
       
                        </div>

                        <div >
                            <label for="itemImg">Upload Image</label>
                            <input type="file" name="itemImg"  id="itemImg" class="form-control"  >
       
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
