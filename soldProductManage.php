<?php 

$processOrderId = $_REQUEST["processOrderId"];
$amount = $_REQUEST["amount"];
$date = date("d-m-y");

$db = mysqli_connect('localhost', 'root', '', 'dailyFood');

$sql="INSERT INTO `soldproduct`(`date`, `amount`) VALUES ('$date','$amount')";
$result=mysqli_query($db, $sql);

$sql="DELETE FROM `customerorder` WHERE id='$processOrderId'";
$result=mysqli_query($db, $sql);

echo "Order processed successfully...!";


?>