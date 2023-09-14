
<?php 

require_once "php/config.php";
if(isset($_POST['save_item']))
{


    $itemName =  $_POST['itemName'];
    $S =  $_POST['S'];
    $M =  $_POST['M'];
    $L  =  $_POST['L'];
    $itemDesc =  $_POST['itemDesc'];
    $itemPrice =  $_POST['itemPrice'];
    $itemImg = $_FILES['itemImg'];
    print_r($_FILES['itemImg']);
    $img_loc = $_FILES['itemImg']['tmp_name'];
    $img_name = $_FILES['itemImg']['name'];
    $img_des= "uploadImage/".$img_name;
    move_uploaded_file($img_loc, 'uploadImage/'.$img_name);

    //insert data
    $query = "INSERT INTO `item` (`itemName`, `S`, `M`, `L`, `itemDesc`, `itemPrice`, `itemImg`) VALUES ('$itemName','$S','$M','$L','$itemDesc','$itemPrice','$img_des')";
    $query_run = mysqli_query($link, $query);

    if($query_run)
    {
        $_SESSION['successmsg'] = " Added Successfully";
        header("Location: list-item.php");
        exit(0);
    }
    else
    {
        $_SESSION['successmsg'] = " Not Added";
        header("Location: list-item.php");
        exit(0);
    }

}

?>
