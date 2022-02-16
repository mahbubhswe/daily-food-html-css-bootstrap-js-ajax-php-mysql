<?php

$db = mysqli_connect('localhost', 'root', '', 'dailyFood');

    if (isset($_GET['price'])) {
    $price = $_GET['price'];

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
</head>
<body>


<div class="admin-nav text-center">
   Daily Food
</div>
<div class="container p-5 w-50">

        <div class="form-group">
            <h4 class="text-center">Check Discount Code</h4>
            <label>Discount code:</label>
            <input type="text" required id="dCode" class="form-control"  placeholder="You have any discount code?">
        </div>
        <p id="discount"></p>
        <button class="btn btn-info"  onclick="checkDiscount()">Check</button>
        <button class="btn btn-success"  onclick="next(<?php echo  $price;?>)">Next</button>
  
</div>


<script>

    var hasDiscount=0;

function checkDiscount() {

   var dCode=document.getElementById("dCode").value;

       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("discount").innerHTML = this.responseText;


                var result = this.responseText.localeCompare("<p style='color: red'>Sorry, your code is invalid</p>");
            
                if (result!=0) {
                  hasDiscount=1;
                }
            }
        };
        xmlhttp.open("GET", "manageDiscount.php?dCode="+dCode, true);
        xmlhttp.send();
    
}

function next(price){

document.location.href="checkout.php?price="+price+"&"+"discount="+hasDiscount;
}

 </script>

</body>
</html>