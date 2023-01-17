<?php
// Include config file
require_once "php/config.php";
 
// Define variables and initialize with empty values
if(isset($_POST['upload']))
{
    $bulkItemID = $_POST['bulkItemID'];
    $bulkItemName = $_POST['bulkItemName'];
    $bulkItemPrice = $_POST['bulkItemPrice'];
    $bulkItemQtty = $_POST['bulkItemQtty'];
    $bulkItemDesc = $_POST['bulkItemDesc'];
    $bulkItemImg = $_FILES['bulkItemImg'];
    print_r($_FILES['bulkItemImg']);
    $img_loc = $_FILES['bulkItemImg']['tmp_name'];
    $img_name = $_FILES['bulkItemImg']['name'];
    $img_des = "uploadImage/".$img_name;
    move_uploaded_file($img_loc, 'uploadImage/'.$img_name);



    //insert data
    $sql = "INSERT INTO `bulkitem` (`bulkItemID`, `bulkItemName`, `bulkItemPrice`, `bulkItemQtty`, `bulkItemDesc`, `bulkItemImg`)
     VALUES ('$bulkItemID','$bulkItemName','$bulkItemPrice','$bulkItemQtty','$bulkItemDesc','$img_des')";
    $query_run = mysqli_query($link, $sql);

    if($query_run)
    {
        $_SESSION['successmsg'] = "Betta Fish Added Successfully";
        header("Location: list-bulkitem.php");
        exit(0);
    }
    else
    {
        $_SESSION['successmsg'] = "Betta Fish Not Added";
        header("Location: list-bulkitem.php");
        exit(0);
    }

}

?>
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
                    <p>Please fill this form and submit to add bulk item intothe database.</p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Item Bulk ID</label>
                            <input type="text" name="bulkItemID" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Item Bulk Item Name</label>
                            <input type="text" name="bulkItemName" class="form-control" value="">
                 
                        </div>
                        <div class="form-group">
                            <label>Price Per Sack</label>
                            <input type="number" name="bulkItemPrice" class="form-control" value="">
        
                        </div>
                        <div class="form-group">
                            <label>Quantity Stocks</label> 
                            <input type="number" name="bulkItemQtty" class="form-control" value="">

                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="number" name="bulkItemDesc" class="form-control" value=""></textarea>

                        </div>
                        <div class="form-group">
                        <label>Upload Image</label>
                            <input type="file" name="bulkItemImg" class="form-control" value="">

                         </div>

                        <br></br>

                        <input type="submit"  name = "upload" class="btn btn-primary" value="Submit">
                        <a href="additem2.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
    </br>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
