<?php
session_start();
error_reporting(0);
include('config/config.php');

if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
    $query=mysqli_query($con,"select AID from admintablecontent where AEmail='$email'");
    $ret=mysqli_fetch_array($query);
    if($ret>0)
	{
      $_SESSION['email']=$email;
	  $_SESSION['checks']=true;
     header('location:reset-password.php');
    }
    else
	{
      $msg=true;
    }
  }
?>
<!doctype html>
<html lang="en">
<head>
   <link rel="stylesheet" href="css/forgotstyle.css">

</head>
<body>
   <h1>Forgot Password</h1>
   <?php if($msg) echo "<ul class='auth-form'><li>Sorry! ".$email." is not associated to any account<span class='close'>&times;</span></li></ul>";?>
   <div class="auth-form" id="login">
      <div class="auth-form-body">	    
         <form method="post" >
            <label>Registered Email:</label>
            <input type="email" name="email" id="login_field" class="form-control" required>
			<input type="submit" class="btn" name="submit" value="Reset Password">
         </form>
      </div>
      <p class="create-new-account">Not Sure? <a href="index.php">Back to Login</a>.</p>
   </div>
   <script>
    var closebtns = document.getElementsByClassName("close");
    for (var i = 0; i < closebtns.length; i++) {
       closebtns[i].addEventListener("click", function() {
        this.parentElement.style.display = 'none';
        });
    }
   </script>
</body>
</html>