<?php
    session_start();
    include('config/config.php');
    if (isset($_POST['register'])) 
	{
        $name= $_POST['name']; 
		$dob=$_POST['dob'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
        $password = md5($_POST['password']);
		$query=mysqli_query($con,"select * from usertablecontent where email='$email' and phone='$phone'");
		$ret=mysqli_fetch_array($query);
		if($ret>0){
			echo "<script>alert('email already exist')</script>";
		}
		else{
			$sql="insert into usertablecontent values('$name','$dob','$phone','$email','$password')";
			if(mysqli_query($con,$sql) === TRUE){
				header('location:cs.php');		
			} 
			else {
				echo "<script>alert('Something went wrong')</script>";
			}
		}
	}    
?>
<html lang="en">

    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/register.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    </head>

    <body>
        <h1>Create Account</h1>        
        <div class="auth-form" id="login">
            <div class="auth-form-body">
                <form method="post">
                    <label>Name:</label>
                    <input type="text" name="name" id="login_field" class="form-control" required>
					<label>Phone:</label>
                    <input type="text" name="phone"  id="login_field" class="form-control" required>					
					<label>Date of Birth:</label>
                    <input type="date" name="dob" id="login_field" class="form-control" required>
					<label>Email:</label>
                    <input type="email" name="email"  id="login_field" class="form-control" required>
					<div class="position-relative">
                        <label>Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <i class="bi bi-eye-slash eye-button" id="togglePassword"></i>                      
					</div>	
					<input type="submit" class="btn" name="register" value="Create Account">    
				</form>
            </div>
            <p class="create-new-account">Not Sure? <a href="index.php">Back to Login</a>.</p>
        </div>
        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            togglePassword.addEventListener('click', function(e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('bi-eye');
            });
        </script>
    </body>
    </html>
