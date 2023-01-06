
<?php 

if(isset($_POST['save_fish']))
{
    $bettaType = $_POST['bettaType'];
    $bettaCategory = $_POST['bettaCategory'];
    $bettaColor = $_POST['bettaColor'];
    $bettaGender = $_POST['bettaGender'];
    $bettaDescription = $_POST['bettaDescription'];
    $bettaPrice = $_POST['bettaPrice'];
    $bettaQuantity = $_POST['bettaQuantity'];
    $bettaStatus = $_POST['bettaStatus'];
    $bettaPic = $_FILES['bettaPic'];
    print_r($_FILES['bettaPic']);
    $img_loc = $_FILES['bettaPic']['tmp_name'];
    $img_name = $_FILES['bettaPic']['name'];
    $img_des = "uploadImage/".$img_name;
    move_uploaded_file($img_loc, 'uploadImage/'.$img_name);

    //insert data
    $query = "INSERT INTO `bettafish` (`bettaType`, `bettaCategory`, `bettaColor`, `bettaGender`, `bettaDescription`, `bettaPrice`, `bettaQuantity`, `bettaStatus`, `bettaPic`) VALUES ('$bettaType','$bettaCategory','$bettaColor','$bettaGender','$bettaDescription','$bettaPrice','$bettaQuantity','$bettaStatus','$img_des')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['successmsg'] = "Betta Fish Added Successfully";
        header("Location: ../bettafishlist.php");
        exit(0);
    }
    else
    {
        $_SESSION['successmsg'] = "Betta Fish Not Added";
        header("Location: ../bettafishlist.php");
        exit(0);
    }

}

?>

$fileinfo = @getimagesize($_FILES["bulkItemImg"]["tmp_name"]);
        $file_extension = pathinfo($_FILES["bulkItemImg"]["name"], PATHINFO_EXTENSION);
        
        // Validate file input to check if is not empty
        if (! file_exists($_FILES["bulkItemImg"]["tmp_name"])) {
            $response = array(
                "type" => "error",
                "message" => "Choose image file to upload."
            );
        }
      else {
            $target = "img/upload" . basename($_FILES["bulkItemImg"]["name"]);
            if (move_uploaded_file($_FILES["bulkItemImg"]["tmp_name"], $target)) {
                $response = array(
                    "type" => "success",
                    "message" => "Image uploaded successfully."
                );
            } else {
                $response = array(
                    "type" => "error",
                    "message" => "Problem in uploading image files."
                );
            }
    }