<?php
require_once "php/config.php";
session_start();

$user_check=$_SESSION['login_user'];
$ses_sql=mysqli_query($con,"select * from retailer where retailerName='$user_check'");
$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$loggedin_session=$row['retailerName'];
$loggedin_id=$row['retailer_ID'];
if(!isset($loggedin_session) || $loggedin_session==NULL) {
 echo "Go back";
 header("Location: retailerHomepage.php");
}
?>