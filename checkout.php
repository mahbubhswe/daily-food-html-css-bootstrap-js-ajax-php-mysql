<?php

$db = mysqli_connect('localhost', 'root', '', 'dailyFood');

$dis=0;

    if (isset($_GET['price']) && isset($_GET['discount'])) {

    $price = $_GET['price'];
    $discount = $_GET['discount'];

    if ($discount==1) {
      $query = "SELECT `amount` FROM `discount` WHERE 1";
      $result=mysqli_query($db, $query);
      $row = mysqli_fetch_assoc($result);
      $dis=$row["amount"];
      $price=$price-$dis;
    }

  } 






    if (isset($_POST['order'])) {

//get product inputed information
    $customerName = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
     $price = $_POST['price'];
    $username = $_POST['username'];
    $date = date("d-m-y");

    $query = "INSERT INTO `customerorder`(`date`, `customerName`, `phone`, `address`, `price`) VALUES ('$date','$customerName','$phone','$address','$price')";
    mysqli_query($db, $query);

      $query = "INSERT INTO `savedorder`(`username`, `date`, `phone`, `address`, `price`) VALUES ('$username','$date','$phone','$address','$price')";
    mysqli_query($db, $query);

    header('location: thankYou.php');

  }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout System</title>
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <style type="text/css">
        strong{
            color: green;
            padding: 5px 0px;
            margin: 15px 0px;
        }
    </style>
</head>
<body>


<div class="admin-nav text-center">
   Daily Food
</div>
<div class="container p-5 w-50">
    <form class="jumbotron" action="#" method="POST" id="checkOutForm">
        <h4 class="text-center">Checkout System</h4>
        <hr>

                <?php 
        if($discount==1)
        {
            echo "<strong>You have got ".$dis." tk discount...!</strong>";
        }
        ?>
             <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required class="form-control"  placeholder="Type Username to Save Your Order">
        </div>
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" required class="form-control"  placeholder="Full Name">
        </div>

        <div class="form-group">
            <label>Phone:</label>
            <input type="tel" name="phone" required class="form-control"  placeholder="Contact number">
        </div>

        <div class="form-group">
            <label>Address:</label>
            <input type="text" name="address" required class="form-control"  placeholder="Address">
        </div>
        
         <div class="form-group">
            <label>Price:</label>
            <input type="text" readonly required value="<?php echo $price ?>" name="price" class="form-control" placeholder="Address">
        </div>
        <button class="btn btn-info"  type="submit" name="order"  >Confirm Order</button>
    </form>
</div>


</body>
</html>