
<?php 

require_once "php/config.php";
if(isset($_POST['save_item']))
{


    $bulkItemName =  $_POST['bulkItemName'];
    $bulkItemPrice =  $_POST['bulkItemPrice'];
    $bulkItemQtty=  $_POST['bulkItemQtty'];
    $bulkItemDesc  =  $_POST['bulkItemDesc'];
    $bulkItemImg = $_FILES['bulkItemImg'];
    print_r($_FILES['bulkItemImg']);
    $img_loc = $_FILES['bulkItemImg']['tmp_name'];
    $img_name = $_FILES['bulkItemImg']['name'];
    $img_des= "uploadImage/".$img_name;
    move_uploaded_file($img_loc, 'uploadImage/'.$img_name);

    //insert data
    $query = "INSERT INTO `bulkitem` (`bulkItemName`, `bulkItemPrice`, `bulkItemQtty`, `bulkItemDesc`, `bulkItemImg`) VALUES ('$bulkItemName','$bulkItemPrice','$bulkItemQtty','$bulkItemDesc','$img_des')";
    $query_run = mysqli_query($link, $query);

    if($query_run)
    {
        $_SESSION['successmsg'] = " Added Successfully";
        header("Location: list-bulkitem.php");
        exit(0);
    }
    else
    {
        $_SESSION['successmsg'] = " Not Added";
        header("Location: list-bulkitem.php");
        exit(0);
    }

}

?>
