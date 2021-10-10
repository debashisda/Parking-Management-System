<?php
session_start();
error_reporting(0);
include('config/config.php');
$sendm=$_SESSION['sendmail'];
$otp=$_SESSION['one'];

	function sendmail($d,$m){
	$sendername='no-reply';
	$subject='Email Verification for VPMS';

	$url= 	"https://email-sender1.p.rapidapi.com/?"
			."txt_msg=".rawurlencode($m)
			."&to=".rawurlencode($d)
			."&from=".rawurlencode($sendername)
			."&subject=".rawurlencode($subject);
			
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
	curl_setopt($curl,CURLOPT_HTTPHEADER,["content-type: application/json","x-rapidapi-host: email-sender1.p.rapidapi.com","x-rapidapi-key: adfb1d4a0fmsh2af7abe71756cc0p1c2da1jsn9de7d98d964e"]);

	$response = curl_exec($curl);
	curl_close($curl);
	}
if(isset($_GET['resend']))
{
	if($_SESSION['sendmail'] !=null)
	{
		$mss="Your One time password: ".$otp;
		sendmail($sendm,$mss);
	}		
	else
		echo "already verified";
}
if(isset($_POST['verify']))
{
	$totp=$_POST['otp'];
	$query=mysqli_query($con,"select otp from usertablecontent where email='$sendm'");   
	$ret=mysqli_fetch_array($query);	
	if($ret['otp'] == $totp)
	{		
		$verifidotp=mysqli_query($con,"update usertablecontent set verified='1' where email='$sendm'");
		$sql=mysqli_query($con,"update usertablecontent set otp='100000' where email='$sendm'");
		$mss="Thankyou you account has been verified! Enjoy our Services";
		sendmail($sendm,$mss);
		header('location:logout.php');		
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
   <h1>Verify your account</h1>
   <?php if($msg) echo "<ul class='auth-form'><li>Invalid OTP!<span class='close'>&times;</span></li></ul>";?>
   <div class="auth-form" id="login">
      <div class="auth-form-body">	    
         <form method="post" >
            <label>Check Your Mail</label>
            <input type="text" name="otp" maxlength="6" id="login_field" class="form-control" required>
			<input type="submit" class="btn" name="verify" value="Verify">
         </form>
      </div> 
		<form method="get">
		<input type="submit" style="cursor:pointer" name="resend" value="Resend">
		</form>
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