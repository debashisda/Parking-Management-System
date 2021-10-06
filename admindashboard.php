<?php
session_start();
error_reporting(0);
include('config/config.php');
error_reporting(0);

if($_SESSION['checks']!==true)
{
	header('location:logout.php');	
}
else
{ 
?>
<html lang="en">

<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" href="css/booking-style.css">
</head>

<body>

   <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="#">About</a>
      <a href="#">Services</a>
      <a href="#">Clients</a>
      <a href="#">Contact</a>
   </div>

   <div id="main">
   
      <div class="aa">
         <div class="topnav">
            <a class="active" href="#home">Home</a>
            <a href="#news">News</a>
            <a href="#contact">Contact</a>
            <a href="logout.php">Logout</a>
         </div>
         <span style="padding-left:10px;font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
      </div>
	  
      <div class="auth-form">
         <form method="post">

            <label>Vehicle Type</label>
            <input type="text" name="username" id="login_field" class="form-control input-block">

            <label>Duration</label>
            <input type="password" name="password" id="password" class="form-control input-block">

            <input type="submit" class="btn" name="book" value="Book">

         </form>
      </div>  
      <div class="auth-form">
         <form method="post">

            <label>Vehicle Type</label>
            <input type="text" name="username" id="login_field" class="form-control input-block">

            <label>Duration</label>
            <input type="password" name="password" id="password" class="form-control input-block">

            <input type="submit" class="btn" name="book" value="Book">

         </form>
      </div>
      <div class="auth-form">
         <form method="post">

            <label>Vehicle Type</label>
            <input type="text" name="username" id="login_field" class="form-control input-block">

            <label>Duration</label>
            <input type="password" name="password" id="password" class="form-control input-block">

            <input type="submit" class="btn" name="book" value="Book">

         </form>
      </div>
      <div class="auth-form">
         <form method="post">

            <label>Vehicle Type</label>
            <input type="text" name="username" id="login_field" class="form-control input-block">

            <label>Duration</label>
            <input type="password" name="password" id="password" class="form-control input-block">

            <input type="submit" class="btn" name="book" value="Book">

         </form>
      </div>
   </div> 

   <script>
      function openNav() {
         document.getElementById("mySidenav").style.width = "200px";
         document.getElementById("main").style.marginLeft = "200px";
      }

      function closeNav() {
         document.getElementById("mySidenav").style.width = "0";
         document.getElementById("main").style.marginLeft = "0";
      }
   </script>
</body>

</html>
<?php } ?>