<?php
   	 session_start();
    	include('config/config.php');
	function sendmail($d,$m)
	{
		$sendername='no-reply';
		$subject='Email Verification for VPMS';
		$url= 	"https://email-sender1.p.rapidapi.com/?"."txt_msg=".rawurlencode("Your One Time Password: ".$m)	."&to=".rawurlencode($d)."&from=".rawurlencode($sendername)."&subject=".rawurlencode($subject);
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($curl,CURLOPT_ENCODING,"");
		curl_setopt($curl,CURLOPT_MAXREDIRS,10);
		curl_setopt($curl,CURLOPT_TIMEOUT,30);
		curl_setopt($curl,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
		curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($curl,CURLOPT_POSTFIELDS,"{\r\n    \"key1\": \"value\",\r\n    \"key2\": \"value\"\r\n}");
		curl_setopt($curl,CURLOPT_HTTPHEADER,["content-type: application/json","x-rapidapi-host: email-sender1.p.rapidapi.com","x-rapidapi-key: <YOUR API KEY>"]);
		$response = curl_exec($curl);
		curl_close($curl);
	}	
   	 if (isset($_POST['register'])) 
	{
        	$name= $_POST['name'];
		$dob=$_POST['dob'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$password=hash('sha256',$_POST['password']);		
		$query=mysqli_query($con,"select * from usertablecontent where email='$email'");
		$ret=mysqli_fetch_array($query);
		if($ret>0)
		{
			echo "<script>alert('Email already in use')</script>";
		}
		else
		{
			$sql="insert into usertablecontent values('$name','$dob','$phone','$email','$password','false','100000')";
			if(mysqli_query($con,$sql) === TRUE)
			{
				$otp = rand(100001,999999);
				sendmail($email,$otp);
				$uotp=mysqli_query($con,"update usertablecontent set otp='$otp' where email='$email'");
				$_SESSION['sendmail']=$email;
				$_SESSION['one']=$otp;
				header('location:verify.php');
			} 
			else
			{
				echo "<script>alert('Something went wrong')</script>";
			}
		}
	}    
?>
<html>
    <head>
    <link rel="stylesheet" href="css/register.css">
    <style>
	@font-face{
	font-family: bootstrap-icons;
	src: url(css/svg/bootstrap-icons.woff2);
	}
	[class*=" bi-"]::before{
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
            <p class="create-new-account">Already having a account? <a href="index.php">Login here</a>.</p>
        </div>
        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            togglePassword.addEventListener('click', function(e){const type = password.getAttribute('type') === 'password' ? 'text' : 'password';password.setAttribute('type', type);this.classList.toggle('bi-eye');});
        </script>
    </body>
</html>
