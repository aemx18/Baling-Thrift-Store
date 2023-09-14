
<?php 

require_once "php/config.php";
if(isset($_POST['submit']))
{
   
    $customerName = $_POST['custName'];
    $customerEmail = $_POST['custEmail'];
    $customerAddress = $_POST['custAddress '];
    $customerPhone  = $_POST['custPhone '];

    //insert data
    $currentCustomer = $_SESSION['custEmail'];
    $sql = "UPDATE customer SET custName=?, custEmail=?, custAddress=?, custPhone=? WHERE custEmail = $currentCustomer";
    $query_run = mysqli_query($link, $query);

    if($query_run)
    {
        $_SESSION['successmsg'] = " Added Successfully";
        header("Location: edit-profile-form.php");
        exit(0);
    }
    else
    {
        $_SESSION['successmsg'] = " Not Added";
        header("Location: edit-profile-form.php");
        exit(0);
    }

}

?>
