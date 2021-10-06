<?php
session_start();
error_reporting(0);
include('config/config.php');

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select AEmail from admintablecontent where AEmail='$username' && APassword='$password' ");
	$reta=mysqli_fetch_array($query);
	$query1=mysqli_query($con,"select email from usertablecontent where email='$username' && password='$password' ");   
	$retu=mysqli_fetch_array($query1);
	if($reta>0)
	{
		$_SESSION['checks']=true;
		header('location:admindashboard.php');
	}
	else if($retu>0)
	{
		$_SESSION['checks']=true;
		header('location:dashboard.php');
	}
   else
	{
		$msg=true;
	}
}
?>
    <html lang="en">

    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
		 <!--link rel="stylesheet" href="css/boots.css">
         <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" /-->
    </head>
	<style>
@font-face {
	font-family: bootstrap-icons;
  src: url(css/svg/bootstrap-icons.woff2);
}
[class*=" bi-"]::before {
  display: inline-block;
  font-family: bootstrap-icons;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
  vertical-align: text-bottom;
  -webkit-font-smoothing: antialiased;
}
.bi-eye-slash::before { content: "\f320"; }
.bi-eye::before { content: "\f321"; }

	</style>

    <body>
        <h1>Welcome Back!</h1>
        <?php if($msg) echo "<ul class='auth-form' id='clsem'><li>Invalid username or password.<span class='close'  onclick='errormessage()'>&times;</span></li></ul>";?>
        <div class="auth-form" id="login">
            <div class="auth-form-body">
                <form method="post">
                    <label>Email:</label>
                    <input type="email" name="username" id="login_field" class="form-control" required autocomplete>
                    <div class="position-relative">
                        <label>Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <i class="bi bi-eye-slash eye-button" id="togglePassword"></i>
                        <input type="submit" class="btn" name="login" value="Log in">
                        <a class="label-link" href="forgot-password.php">Forgot password?</a>
                    </div>
                </form>
            </div>
            <p class="create-new-account">New here? <a href="create-account.php">Create an account</a>.</p>
        </div>
        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            togglePassword.addEventListener('click', function(e){const type = password.getAttribute('type')==='password'?'text':'password';password.setAttribute('type',type);this.classList.toggle('bi-eye');});
		</script>
		<script>function errormessage(){document.getElementById("clsem").style.display='none';}</script>
    </body>
    </html>