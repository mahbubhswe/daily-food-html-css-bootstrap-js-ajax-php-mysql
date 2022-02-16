<?php 
session_start();
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
$msg="";

if(!$_SESSION["username"]){
header('location: login.php');
}


//product save to database
    if (isset($_POST['save'])) {
     $target = "img/".basename($_FILES['img']['name']);

//get product inputed information
    $productCategory = $_POST['category'];
    $price = $_POST['price'];
    $img = $_FILES['img']['name'];

    $query = "INSERT INTO product(category, price, img) value('$productCategory', '$price', '$img')";
    mysqli_query($db, $query);

    if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
      $msg = "Product saved";
     }else{
      $msg="Product not saved";
    }

  }


//delete product from database
    if (isset($_GET['deleteId'])) {

    $productId = $_GET['deleteId'];

    $query = "DELETE FROM product WHERE id=$productId";
    mysqli_query($db, $query);

  }

  //delete order from database
    if (isset($_GET['deleteOrderId'])) {

    $deleteOrderId = $_GET['deleteOrderId'];

    $query = "DELETE FROM customerorder WHERE id=$deleteOrderId";
    mysqli_query($db, $query);

  }


//discount update
    if (isset($_POST['disBtn'])) {

    $title = $_POST['title'];
    $code = $_POST['code'];
    $amount = $_POST['amount'];


    $query = "UPDATE `discount` SET `amount`='$amount',`title`='$title',`code`='$code'";
    mysqli_query($db, $query);

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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


<!-- admin page -->
<div class="admin-page">

<!-- side bar -->
    <div class="side-bar" style="position: sticky">
      
       <div class="list-group">
        <button class="list-group-item  active" >Admin Dashboard</button>
        <button class="list-group-item"  onclick="changeContent('checkOrder')"><i class="fas fa-list-alt"></i> Check Order</button>
        <button class="list-group-item" onclick="changeContent('showAllItems')"><i class="fas fa-search-plus"></i> Show All Items</button>
        <button class="list-group-item" onclick="changeContent('addNewItems')"><i class="fas fa-plus-square"></i> Add New Item</button>
        <button class="list-group-item" onclick="changeContent('setDiscunt')">Set Discunt</button>
        <button class="list-group-item" onclick="changeContent('checkCash')"><i class="far fa-money-bill-alt"></i> Cash Check</button>
        <button class="list-group-item" onclick="changeContent('settings')"><i class="fas fa-cog"></i> Settings</button>

    </div>
    </div>

<!--main content-->



    <div class="content" id="checkOrder">
       <h1>Check Order List</h1>

       <p id="orderProcess" style="color: green"></p>

      <table class="table table-striped">
      <thead>
    <tr>
      <th>Order ID</th>
      <th>Customer Name</th>
       <th>Date</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Price</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php

//fatch product from database
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
 $selectQuery="SELECT *FROM `customerorder`";

  $result = mysqli_query($db, $selectQuery);

  while($row = mysqli_fetch_assoc($result)):?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['customerName']; ?></td>
      <td><?php echo $row['date']; ?></td>
      <td><?php echo $row['phone'];?></td>
      <td><?php echo $row['address'];?></td>
      <td><?php echo $row['price'];?></td>
      <td>
        <button class="btn btn-info" onclick="orderProcess(<?php echo $row['id'];?>,<?php echo $row['price'];?>)">
        Process</button>
        <a class="btn btn-danger" href="dashboard.php?deleteOrderId=<?php echo $row['id'];?>">Delete</a>
      </td>
    </tr>
  
<?php endwhile; ?>
  </tbody>
  </table>

    </div>




    <div class="content" id="showAllItems">
       <h1>Show All Items List</h1>
     <table class="table table-striped">
  <thead>
    <tr>
      <th>Category</th>
      <th>Img</th>
      <th>Price</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

<?php

//fatch product from database
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
 $selectQuery="SELECT * FROM product";

  $result = mysqli_query($db, $selectQuery);

  while($product = mysqli_fetch_assoc($result)):?>
    <tr>
      <td><?php echo $product['category']; ?></td>
      <td><img src="img/<?php echo $product['img'];?>" height="50px" width="50px"></td>
      <td><?php echo $product['price'];?></td>
      <td>
        <a class="btn btn-info" href="editProduct.php?editId=<?php echo $product['id'];?>">Edit</a>
        <a class="btn btn-danger" href="dashboard.php?deleteId=<?php echo $product['id'];?>">Delete</a>
      </td>
    </tr>
  
<?php endwhile; ?>



  </tbody>
</table>



    </div>



        <div class="content" id="addNewItems">

           <h1>Add New Items</h1>
        <form action="dashboard.php" method="POST" class="jumbotron"  id="addFoodForm" enctype="multipart/form-data">
        <div class="form-group">
        <select name="category" class="custom-select" id="category">
            <option selected>Select</option>
            <option value="pizza">Pizza</option>
              <option value="drink">Drink</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" name="price" id="price" placeholder="Price" class="form-control">
    </div>

        <div class="form-group">
        <input type="file" name="img" id="img" class="form-control">
    </div>

    <button type="submit" name="save" class="btn btn-success" id="addFoodBtn" disabled>Save</button>
     </form >

    </div>


     <div class="content" id="setDiscunt">
       <h1>Give Discunt</h1>
     <form class="jumbotron" action="#" method="POST">

         <div class="form-group">
            <label>Title:</label>
         <input type="text" required name="title" placeholder="Title" class="form-control">
         </div>

          <div class="form-group">
            <label>Discount code:</label>
         <input type="text" required name="code" placeholder="Discount code" class="form-control" >
         </div>

          <div class="form-group">
            <label>Discount Amount:</label>
         <input type="number" required name="amount" placeholder="Discount" class="form-control">
         </div>

         <button class="btn btn-success" type="submit" name="disBtn" >Save</button>

     </form>
    </div>



        <div class="content" id="checkCash">
       <h1>Cash Check</h1>
       <table class="table table-striped">
       <thead>
    <tr>

      <th>No. of Order</th>
      <th>Total Amout</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td> 
                <?php
         $sql = "SELECT COUNT(id) as total FROM `soldproduct`";
         $result = mysqli_query($db, $sql);

         while($row = mysqli_fetch_assoc($result)){
         echo $row['total'];
     } 
?>
      </td>
      <td>
        <?php
         $sql = "SELECT SUM(amount) as total FROM `soldproduct`";
         $result = mysqli_query($db, $sql);

         while($row = mysqli_fetch_assoc($result)){
         echo $row['total'];
     } 
?>
  
</td>
    </tr>
  </tbody>
   </table>

    </div>



   <div class="content" id="settings">
       <h1>Settings</h1>
      <button class="btn text-info"><i class="fas fa-key"></i> Change Password</button>
      <br>
      <button class="btn mt-3 text-danger"><i class="fas fa-sign-out-alt"></i><a href="logout.php" style="color: red">Logout</a></button>

    </div>



<!--end admin page-->
</div>
<script type="text/javascript">
  function orderProcess(id,amount){

       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("orderProcess").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "soldProductManage.php?processOrderId="+id+"&"+"amount="+amount, true);
        xmlhttp.send();
  }
</script>

<script type="text/javascript" src="app.js"></script>

</body>
</html>
