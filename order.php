

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>

    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

</head>
<body style="background-color: #FFFFFF">

<div class="admin-nav text-center">
    Your Cart
    <button class="btn btn-info" onclick="resetCard()">Clear</button>
    <a href="profile.php">Profile</a>
</div>

<div style="width: 90%;margin: 50px auto">
	<a href="index.php" id="cardIsEmpty"  style="color: red;text-align: center;font-size: 25px"></a>

	<div style="width: 55%;float: left;">


 <?php
 

//fatch product from database
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
 $selectQuery="SELECT * FROM `addtocard`";

  $result = mysqli_query($db, $selectQuery);

       
  while($product = mysqli_fetch_assoc($result)):?>

  	<?php 
  	 $productId=$product['id'];
  	 $selectImg="SELECT `img` FROM `product` WHERE `id`=$productId";
     $img = mysqli_query($db, $selectImg);
     $productImg = mysqli_fetch_assoc($img)
  	?>



<div class="card " style="background-color: #E5E5E5">
    <div  class="card-body">
    	<div style="width: 30%;float: left;">
    		<img src="img/<?php echo $productImg['img'];?>" height="90px" width="90px">
    	</div>
    	<div style="width: 70%;float: left;">
    		<div><strong>Price: </strong><?php echo $product['price']; ?></div>
    		   <div><strong>Total: </strong>
    			<span class="total" id="<?php echo $product['id']; ?>"><?php echo $product['price']; ?></span>
    		</div>
    	
    		<div>
    			<strong>Quantity:</strong>
    			<button class="btn btn-info" style="border-radius: 50px" onclick="remove(<?php echo $product['price']; ?>,<?php echo $product['id']; ?>,<?php echo 50000+$product['id']; ?>)">-</button>
    			<span id="<?php echo 50000+$product['id']; ?>"> <?php echo $product['quantity']; ?> </span>
    			<button class="btn btn-info" style="border-radius: 50px" onclick="add(<?php echo $product['price']; ?>,<?php echo $product['id']; ?>,<?php echo 50000+$product['id']; ?>)">+</button>
    		</div>
    		
    	</div>
    </div>
</div>

  <br>
<?php endwhile; ?>





</div>

<div style="width: 30%;float: left;margin-left: 10%">
	        <!-- order summary-->
    <div class="order-summery" id="order-summery">
<h5 class="text-center">Order Summery</h5>
        <hr>
        <h6><strong>Total Price: </strong><span id="totalPrice"></span></h6>
        <h6><strong>Delivery Charge: </strong>50 tk</span></h6>
        <hr>
        <h6><strong>Total:</strong><span id="sum"></span></h6>
<button class="btn btn-info" onclick="checkOut()">Checkout</button>
    </div>
</div>
</div>

<script type="text/javascript">


totalCounter();

 function remove(price,id,qtyId){

 	 	let quantity = document.getElementById(qtyId).innerText;
      
        quantity--; 
 	 	if (quantity>-1) {
 	 		
 	 		 document.getElementById(id).innerHTML=price*quantity;
               document.getElementById(qtyId).innerHTML=quantity;
               totalCounter();
              
 	 	}else{
           alert("Sorry,you have reached in minimum quantity");
 	 	}

 
 }

 function add(price,id,qtyId){

 		let quantity = document.getElementById(qtyId).innerText;
    
        quantity++; 
 	 
 	 	if (quantity<4) { 
 	 		 document.getElementById(id).innerHTML=price*quantity;
               document.getElementById(qtyId).innerHTML=quantity;
               totalCounter();
               
 	 	}else{
           alert("Sorry,you have reached in maximum quantity");
 	 	} 



 	 }


 function totalCounter(){
 

let total=0;
let sum=0;
let totalPriceRow = document.getElementsByClassName('total');

for (var i = 0; i < totalPriceRow.length; i++) {
	
	total = total + parseInt(totalPriceRow[i].innerText);
    
}


if(total==sum){
	  document.getElementById('cardIsEmpty').innerHTML="Sorry, your card is empty...! Goto home page";
    document.getElementById('order-summery').style.display="none";
}else{
  document.getElementById('order-summery').style.display="block";
   document.getElementById('cardIsEmpty').style.display="none";
  document.getElementById('totalPrice').innerHTML=total;
  document.getElementById('sum').innerHTML=total+50;
}


	






 	 	}

 	 	function checkOut(){

          
          if (confirm("Are you sure,you want to checkout now?")){
                   sum = parseInt(document.getElementById('sum').innerText);

                 document.location.href="checkDiscount.php?price="+sum;

          }

 	 	}

function resetCard(){
	
    
              if (confirm("Attention please,your card will be reset.")){
                 <?php 
                  $db = mysqli_connect('localhost', 'root', '', 'dailyFood');
	              $query = "DELETE FROM `addtocard`";
                   mysqli_query($db, $query);

                 ?>
       
             
             window.location.reload(true);

          }

}

</script>


</body>
</html>
