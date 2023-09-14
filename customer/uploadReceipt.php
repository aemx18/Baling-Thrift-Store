
<?php 

require_once "php/config.php";
if(isset($_POST['upload']))
{

    $paymentStatus = $_POST['paymentStatus'];
   $uploadR = $_FILES['itemImg'];
    print_r($_FILES['uploadR']);
    $img_loc = $_FILES['uploadR']['tmp_name'];
    $img_name = $_FILES['uploadR']['name'];
    $img_des= "uploadFile/".$img_name;
    $ordersID = $_GET["ordersID"];
    move_uploaded_file($img_loc, 'uploadFile/'.$img_name); 


    //insert data
    $query = "INSERT INTO `payment` (`paymentStatus`,`uploadR`,ordersID) VALUES ('$paymentStatus','$img_des', '$ordersID')";
    $query_run = mysqli_query($link, $query);

var_dump($paymentStatus);

    if($query_run)
    {
        $_SESSION['successmsg'] = " Added Successfully";
        header("Location: listPayment.php");
        exit(0);
    }
    else
    {
        $_SESSION['successmsg'] = " Not Added";
        header("Location: listPayment.php");
        exit(0);
    }

}

?>
