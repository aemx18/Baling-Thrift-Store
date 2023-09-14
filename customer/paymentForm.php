<?php
// Include config file
require_once "php/config.php";
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Receipt</title>
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
                <a class="btn btn-primary" href="customerHomepage.php">Back</a>
                    <h2 class="mt-5">


                    <form action="#" method="post" enctype="multipart/form-data">
                      
                    <div >
                            <label for="itemImg">Total</label>
                            <input type="text" name="bulkItemImg"  id="itemImg" class="form-control" value="RM25.50" disabled  >
       
                        </div>

                        
                        <div >
                            <label for="itemImg">Payment Status</label>
                            <input type="text" name="bulkItemImg"  id="itemImg" class="form-control" value="Not Pay" disabled  >
       
                        </div>

                        <div >
                            <label for="itemImg">Upload Receipt</label>
                            <input type="file" name="bulkItemImg"  id="itemImg" class="form-control"  >
       
                        </div>

                        <br></br>

                        <input type="submit" class="btn btn-primary" value="submit" name="save_item">
                        <a href="paymentForm.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
    </br>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
