
<?php 

require_once "php/config.php";
if(isset($_POST['update']))
{

$paymentID = $_POST['paymentID'];
$paymentStatus = $_POST['paymentStatus'];

   // $stmt = $link->prepare('UPDATE cartcust SET itemQtty=?, total_price=? WHERE id=?');
    //insert data
    var_dump($_POST);
    $query = "UPDATE payment SET paymentStatus = '$paymentStatus' WHERE paymentID = '$paymentID'" ;
    
    $query_run = mysqli_query($link, $query);



    if($query_run)
    {
        $_SESSION['successmsg'] = " Added Successfully";
        header("Location: list-order.php");
        exit(0);
    }
    else
    {
        $_SESSION['successmsg'] = " Not Added";
        header("Location: list-order.php");
        exit(0);
    }

}

?>
