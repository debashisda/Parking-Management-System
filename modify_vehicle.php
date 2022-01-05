<?php
   session_start();
   require('includes/dbconnection.php');
   
   //fetching all subjects enrolled by user
   $q="select * from student_subjects";
   $st=mysqli_query($con,$q);
   
   //fetching all subjects from the databases
   $q2="select * from all_subjects";
   $db=mysqli_query($con,$q2);
   
   //adding new subject in student subject table
   if(isset($_GET['add']))
   {
    $a=$_GET['sub'];
    //if the user tries to add a existing subject
    $ss=mysqli_query($con,"select name from student_subjects where name='$a'");
    $search_true=mysqli_fetch_array($ss);	   
    if($search_true>0)	   	   
    {
     header('location:student_dashboard.php');
    }	
    else //successfully add a subject to student subject table  
    {
   $insert_sub="insert into student_subjects values('$a')";
   mysqli_query($con,$insert_sub);
   header('location:student_dashboard.php');
    }     
   }
   
   //remove subject from the student subject table
   if(isset($_GET['rms']))
   {
   $r=$_GET['rms'];		
   $rem_sub=mysqli_query($con,"delete from student_subjects where name='$r'");
   header('location:student_dashboard.php');		
   }
   ?>
<html>
   <head>
      <style>
         *{
         font-size:25px;
         }
         fieldset {
         background-color: #eeeeee;
         border-radius:10px;
         border:3px solid black;
         margin-top:50px;
         }
         legend {
         background-color: gray;
         color: white;
         padding: 10px 20px;
         border-radius:5px;
         border:3px solid black;
         margin-left:15px;
         }
         input{  
         margin: 5px;
         }
         .fld{
         margin:30px;
         !margin-right:1200px;!imprtant
         }
         .infld{ 
         padding:10px
         }
         table
         {
         border-radius:5px;
         border:6px black;
         }
         th{
         background:black;
         color:white;
         border-radius:5px;
         padding:10px 20px;
         width:50%;	
         }
         td{
         background:gray;
         color:#eeeeee;
         border-radius:5px;
         padding:7px 20px;
         border:3px solid black;
         width:50%;
         }
         button {
         border-radius:5px;
         padding:7px 10px;
         border:2px solid;	
         font-size:18px; 	
         }
         .rms-bt{
         background:#f96d6d;
         cursor:pointer;	
         }
         .rms-bt:hover{
         background:#c15b5b;	
         color:white;
         }
         .exp-btn{
         background:#9ae39c;
         cursor:pointer;
         }
         .exp-btn:hover{
         background:#009704;
         color:white;	
         }
         select{
         border-radius:5px;
         padding:7px 15px;
         border:2px solid;	
         font-size:18px; 
         }
         .add-sub {
         background:#f1d196;
         cursor:pointer;
         border:2px solid;
         font-size:18px; 
         padding:7px 10px;	
         }
         .add-sub:hover {
         background:orange;
         }
      </style>
   </head>
   <body>
      <fieldset class="fld">
         <legend>My Subjects</legend>
         <div class="infld">
            <table width='500' cellpadding='5' cellspacing='3'>
               <tr>
                  <th>Subjects</th>
                  <th>Options</th>
               </tr>
			   <!-- this form is used to explore/remove subject-->
               <form action="student_dashboard.php" method='get'>		
                  <?php 				
                     while($i=mysqli_fetch_assoc($st))
                     { 
                     	echo "<tr><td>".$i['name']."</td>";
                     	echo "<td align='center'><button class='exp-btn'>Explore</button>&nbsp;<button type='submit' class='rms-bt' name='rms' value=".'"'.$i['name'].'"'.">Remove</button></td></tr>";
                     }
                     ?>
               </form>
			   
			   <!-- this form is used to add new subject-->
               <form action="student_dashboard.php" method='get'>
                  <tr>
                     <td width='50%'>
                        <select name='sub' required>
                           <option selected disabled value=''>Select</option>
                           <?php while($i=mysqli_fetch_assoc($db))
						   {
							   echo "<option value=".'"'.$i['sub_list'].'"'.">".$i['sub_list']."</option>";
							}
					   ?>
                        </select>
                     </td>
                     <td><button type='submit' name='add' class='add-sub'>Add to my subjects</button></td>
				  </tr>
			   </form>
            </table>
      </fieldset>
      </div>
   </body>
</html>