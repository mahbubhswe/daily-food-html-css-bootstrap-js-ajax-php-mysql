<?php 

$id = $_REQUEST["id"];
$price = $_REQUEST["price"];

$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
$sql="INSERT INTO `addtocard`(`id`, `price`, `quantity`) VALUES ($id, $price,1)";
mysqli_query($db, $sql);



$sql = "SELECT SUM(quantity) as total FROM `addtocard`";
    $result = mysqli_query($db, $sql);

    while($row = mysqli_fetch_assoc($result)){
    echo $row['total'];
}


?>