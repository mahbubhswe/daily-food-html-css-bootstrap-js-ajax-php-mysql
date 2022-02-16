<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');

$category="";
$img="";
$price="";
//get edit product info
    if (isset($_GET['editId'])) {

    $productId = $_GET['editId'];

//fatch product from database

 $selectQuery="SELECT * FROM product WHERE id='$productId'";

  $result = mysqli_query($db, $selectQuery);

  $product = mysqli_fetch_assoc($result);
    $category = $product['category'];
      $img = $product['img'];
       $imgo = $product['img'];
      $price = $product['price'];
    }


    //update product to database
    if (isset($_POST['update'])) {

     $target = "img/".basename($_FILES['img']['name']);

//get product inputed information
    $productId = $_POST['productId'];
    $productCategory = $_POST['category'];
    $price = $_POST['price'];
    $img = $_FILES['img']['name'];

    $query = "UPDATE product SET category='$productCategory', price='$price', img='$img' WHERE id='$productId'";
    mysqli_query($db, $query);

    if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
      $msg = "Product updated";
     }else{
      $msg="Product not updated";
    }

    header('location: dashboard.php');

  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

</head>
<body>

 <!--nav bar-->
<div class="admin-nav text-center">
<a href="index.php">Daily Food</a>
</div>


<!--main content-->



        <div class="container w-50 mt-5 pb-3 bg-white rounded">
           <h1 class="text-center pb-2">Update Product</h1>
        <form action="editProduct.php" method="POST" class="jumbotron"  id="addFoodForm" enctype="multipart/form-data">
        	<input type="hidden" value="<?php echo $productId; ?>" name="productId">
       <div class="form-group">
        <img src="img/<?php echo $img;?>" height="200px" width="200px">
    </div>
            <div class="form-group">
        <input type="file" value="<?php echo $img;  ?>" name="img" class="form-control">
    </div>

        <div class="form-group">
        <select name="category" class="custom-select">
            <option selected value="<?php echo $category; ?>"><?php echo $category; ?></option>
            <option value="pizza">Pizza</option>
              <option value="drink">Drink</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" name="price" value="<?php echo $price; ?>"   placeholder="Price" class="form-control">
    </div>



    <button type="submit" name="update" class="btn btn-success">Update</button>
     </form >

    </div>


</body>
</html>
