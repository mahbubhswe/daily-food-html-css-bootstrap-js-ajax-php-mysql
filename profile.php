<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
$uname='';
if(!$_SESSION["username"]){
header('location: userLogin.php');
}

$uname=$_SESSION["username"];



//delete previous order from database
    if (isset($_GET['nameUser'])) {

    $nameUser = $_GET['nameUser'];

    $query = "DELETE FROM `savedorder` WHERE username='$uname'";
    mysqli_query($db, $query);

  }


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="admin-nav text-center">
    Wellcome  <?php echo $uname; ?> 
        <a href="index.php">Goto home...</a>
</div>



    <div  style="width: 60%;margin: 0px auto;">
       <h1>Previus Order List</h1>

      <table class="table table-striped">
      <thead>
    <tr>
      <th>Username</th>
       <th>Date</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
<?php

//fatch product from database
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');
 $selectQuery="SELECT * FROM `savedorder` WHERE `username`='$uname'";

  $result = mysqli_query($db, $selectQuery);

  while($row = mysqli_fetch_assoc($result)):?>
    <tr>
      <td><?php echo $row['username']; ?></td>
         <td><?php echo $row['date']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo $row['address'];?></td>
      <td><?php echo $row['price'];?></td>
    </tr>
  
<?php endwhile; ?>
  </tbody>
  </table>

    </div>
<div style="width: 50%;margin: 0px auto;display: flex;flex-wrap: wrap;">
  <button class="btn btn-danger" onclick="logout()">Logout</button>
  <button class="btn btn-info" onclick="clearMyCard('deleteNow')">Clear Your Card</button>
</div>


<script type="text/javascript">
  
    function logout(){

          
          if (confirm("Are you sure,you want to logout now?")){
                 document.location.href="userLogout.php";

          }

    }

        function clearMyCard(name){

          
          if (confirm("Your card will be reset.")){
                document.location.href="profile.php?nameUser="+name;

          }

    }
</script>

</body>
</html>