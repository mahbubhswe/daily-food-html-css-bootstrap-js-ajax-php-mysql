<?php 

$dCode = $_REQUEST["dCode"];

$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
$sql="SELECT `amount` FROM `discount` WHERE `code`='$dCode'";
$result=mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
	$amount=$row["amount"];
	echo "<p style='color: green'>Congratulation...! You have got ".$amount." tk discount...!</p>";
}else{
	echo "<p style='color: red'>Sorry, your code is invalid</p>";
}






?>