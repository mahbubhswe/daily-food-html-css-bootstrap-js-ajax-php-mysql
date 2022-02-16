<?php

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');

$sql="SELECT * FROM `discount`";
 $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Daily Food</title>
<link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body>

<!-- Navbar Start -->
<div class="navBar">

    <span class="logo">dailyFood</span>

    <ul class="navList" style="margin-bottom: 0px !important;">
        <li><a class="active" href="#">Home</a></li>
        <li><a href="#pizzaSection">Pizza</a></li>
        <li><a href="#softDrinkSection" >Soft Drink</a></li>
    </ul>

    <a href="order.php" class="text-info login"><i class="fas fa-shopping-cart "><sup id="numberOfItems"></sup></i></a>
    <a href="dashboard.php"  class="login"><i class="fas fa-tachometer-alt"></i></a>

</div>
<!-- Navbar End -->


<!-- home section Start -->
<section id="homeSection">
<div class="slider-container">

    <div class="slider"> </div>
    <marquee>
      <h4 class="text-white mt-2">
        Enjoy <?php echo $row["title"]; ?> offer to get <?php echo $row["amount"]; ?>tk discount use <?php echo $row["code"]; ?> code
      </h4>
    </marquee>

</div>
</section>
<!-- home section end -->

<!-- pizza section Start -->
<section id="pizzaSection">

    <h1 class="text-center text-info m-3">Pizza</h1>

    <!-- food Start -->
    <div class="foodSection">


<?php

//fatch product from database
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
 $selectQuery="SELECT `id`, `price`, `img` FROM `product` WHERE `category`='pizza'";

  $result = mysqli_query($db, $selectQuery);

  while($product = mysqli_fetch_assoc($result)):?>

            <div class="foodBox">
            <img src="img/<?php echo $product['img'];?>" height="70%" width="100%">
            <div class="text-center text-info p-3">BDT: <?php echo $product['price']; ?> TK</div>
            <div class="text-center"><button class="btn  btn-info " onclick="addToCard(<?php echo $product['id'];?>,<?php echo $product['price']; ?>)">Add To Card</button></div>
        </div>

  
<?php endwhile; ?>


      

    </div>
    <!-- food section end -->

</section>
<!-- home section end -->

<!-- drink section Start -->
<section id="softDrinkSection">

    <h1 class="text-center text-info m-3 mt-5">Soft Drinks</h1>

    <!-- food items Start -->
    <div class="foodSection">

       <?php

//fatch product from database
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
 $selectQuery="SELECT `id`, `price`, `img` FROM `product` WHERE `category`='drink'";

  $result = mysqli_query($db, $selectQuery);

  while($product = mysqli_fetch_assoc($result)):?>



            <div class="foodBox">
            <img src="img/<?php echo $product['img'];?>" height="70%" width="100%">
            <div class="text-center text-info p-3">BDT:  <?php echo $product['price']; ?> TK</div>
            <div class="text-center"><button class="btn  btn-info " onclick="addToCard(<?php echo $product['id'];?>,<?php echo $product['price']; ?>)">Add To Card</button></div>
        </div>

  
<?php endwhile; ?>

    </div>
    <!-- food items end -->

</section>
<!-- drink section end -->

<!-- footer  Start -->
<footer class="footerSection">
<h3 class="mt-4 text-success text-center">Social Media...</h3>
<div class="footerItem">
    <a href="https://www.facebook.com/"><i class="icon fab fa-facebook-square"></i></a>
    <a href="https://www.youtube.com/"><i class="icon fab fa-google-plus-square"></i></a>
    <a href="https://twitter.com/"><i class="icon fab fa-twitter-square"></i></a>
</div>

</footer>
<!-- footer  Start -->
<div class="goToTop text-right"> <a class="rounded" href="#"><i class="fas fa-arrow-alt-circle-up"></i></a></div>


<script>
function addToCard(id,price) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("numberOfItems").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "addToCard.php?id="+id+"&"+"price="+price, true);
        xmlhttp.send();
    
}
</script>
</body>
</html>

