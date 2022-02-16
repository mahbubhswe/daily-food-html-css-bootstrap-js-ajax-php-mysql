<?php
session_start();

$username = "";
$message="";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'dailyFood');

if (isset($_POST['username'])) {

  // get input values
  $username = mysqli_real_escape_string($db, $_POST['username']);

  $result = mysqli_query($db, "SELECT `username` FROM `savedorder` WHERE `username`='$username'");
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    $_SESSION["username"] = $username;
    header('location: profile.php');
  }else
  {
         $message = "Invalid Username or Password!";
  }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login System</title>
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

   
</head>
<body>



<div class="container-fluid w-50 mt-5">

    <form action="#" method="POST" id="loginForm" class="jumbotron" onsubmit="return login()" >

        <h2 class="text-center text-info border-bottom pb-3">User Login</h2>

            <?php 
        if($message!="")
        {echo '<div  class="alert alert-danger">Sorry,This is not valid username.Try again...!</div>';}
        ?>

        <div class="form-group">
            <label>Username:</label>
            <input type="text" class="form-control" id="userName" placeholder="Username" name="username">
        </div>


        <button class="btn btn-info"  type="submit" disabled id="logBtn">Login</button>

    </form>

</div>


 <script>
 	//login form validation
loginForm.addEventListener('input',()=>{
    if(userName.value.length>0) {
        logBtn.removeAttribute("disabled"); 
    }else{
        logBtn.setAttribute("disabled",true);
    }
})


 </script>

</body>
</html>
