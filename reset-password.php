<?php
session_start();
error_reporting(0);
include('config/config.php');
error_reporting(0);

if($_SESSION['checks']!==true)
{
	header('location:logout.php');	
}
if(isset($_POST['submit']))
{
    $email=$_SESSION['email'];
    $password=md5($_POST['newpassword']);

    $query=mysqli_query($con,"update admintablecontent set APassword='$password'  where AEmail='$email' ");
	if($query)
	{
		echo "<script>alert('Password successfully changed');</script>";
		session_destroy();
		header('location:index.php');
	}  
}
?>
<!doctype html>
<html lang="eng">
<head>    
    <title>Reset Password</title>
    <link href='css/resetstyle.css' rel='stylesheet' type='text/css'>	
	<script>
		function checkpass()
		{
			if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
			{
				alert('New Password and Confirm Password field does not match');
				document.changepassword.confirmpassword.focus();
				return false;
			}
			return true;
		} 
	</script>
</head>
<body>    
<h1>Parking Management System</h1>             
<div class="auth-form">
	<div class="auth-form-body">
		<form method="post" name="changepassword" onsubmit="return checkpass();">			
             <label>New Password</label>
             <input type="password" class="form-control" name="newpassword" placeholder="New Password" required>           
             <label>Confirm Password</label>
             <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>                 
             <button type="submit" name="submit" class="btn">Reset</button>                
        </form>
    </div>
</div>
</body>
</html>
