<?php
include"engine/db.php";
//print_r($_POST);
session_start();
$message= '';

if(isset($_POST['submit'])){
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$borrow = $_POST['borrow'];
$password = $_POST['password']; 
$password = md5($password);     //password convert into MD5   
@$user_id = $_POST['user_id'];
$expire_date = $_POST['date'];
$user_address = $_POST['user_address'];    
@$check_box = $_POST['check_box'];    
$confirm_password = $_POST['confirm_password']; //null option right now
$datenow = date("Y-m-d");   //current date

    
//checking all exists account (email)
$query="SELECT * from student where email = '$email'";
$result = mysqli_query($conn,$query);
if ($result) {
  if (mysqli_num_rows($result) > 0) {
    $message="This email is already used"; // stop duplicate data fire in sql
  } else {

      
//===============================================>
//profile moved (upload)
$file_name = $_FILES['image']['name'];
$file_tmp =$_FILES['image']['tmp_name'];
move_uploaded_file($file_tmp,"images/".$file_name);

//signuture moved (upload)
$file_name2 = $_FILES['image2']['name'];
$file_tmp2 =$_FILES['image2']['tmp_name'];
move_uploaded_file($file_tmp2,"images/".$file_name2);   
//=============================================>      
      

//Fire the SQL Query
$sql = "INSERT INTO `student` (`id`, `firstname`, `lastname`, `email`, `password`, `book`, `user_id`, `expire_date`,`user_address`, `profile_pic`, `signature`, `check_box`, `datenow`) VALUES (NULL, '$firstname', '$lastname', '$email', '$password', '$borrow', '$user_id', '$expire_date', '$user_address', '$file_name', '$file_name2', '$check_box','$datenow')";
    
  
//collect data to session
if ($conn->query($sql) === TRUE) {

//last insert ID store in SESSION
$last_id = $conn->insert_id;
@$_SESSION['id'] = $last_id;  
$me = $last_id;  
    
$message= "Your Information recorded successfully";
    
 //path
$path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$path .=$_SERVER["SERVER_NAME"]. dirname($_SERVER["PHP_SELF"]);   
    
//Javascript redirect after 5 sec    
echo $success ="<script>
         setTimeout(function(){
            window.location.href = '$path/card.php?id=$me';
         }, 5000);
      </script>";    
} else {
  $message= "Something is wrong. Please contact admin.. <br>" . $conn->error;
}
    
$conn->close();
}


//checking data end    
}
}
;?>




<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link href="style.css" rel="stylesheet">
          <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        
        <div class="container">   
      
           <fieldset> <legend> <h1> Registration</h1></legend> 
            
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="Rtable">    
        <tr><td>
            <div class="input-wrapper">
            <input type="text" name="firstname" placeholder="First Name" required>
            <label for="stuff" class="fa fa-address-card-o input-icon"></label>
                </div>
            </td>
            <td>
            <div class="input-wrapper">
            <input type="text" name="lastname" placeholder="Last Name" required>
            <label for="stuff" class="fa fa-address-card-o input-icon"></label>
                </div>
            </td></tr>
            
            
            <tr><td>
                <div class="input-wrapper">
                <input type="email" name="email" placeholder="example@website.com" required>
                <label for="stuff" class="fa fa-envelope-o input-icon"></label>
                </div>
                </td>
                
             <td>
                 <div class="input-wrapper">
                 <input type="text" name="borrow" placeholder="Borrow Book" required>
                <label for="stuff" class="fa fa-book input-icon"></label>
                </div>
                </td>
            </tr>
            
            <tr><td>
                <div class="input-wrapper">
                <input type="password" name="password" placeholder="Password" required>
                <label for="stuff" class="fa fa-key input-icon"></label>
                </div>
                </td>
                
            <td>
                <div class="input-wrapper">
                <input type="number" name="user_id" placeholder="User ID" required>
                <label for="stuff" class="fa fa-user input-icon"></label>
                </div>
                </td>
                
                
             
                
            </tr>
         
            
            <tr>
                <td>
                <div class="input-wrapper">
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <label for="stuff" class="fa fa-key input-icon"></label>
                </div>
                </td>
                
            <td>
                <div class="input-wrapper">
                <input type="text" placeholder="Expiry Date" onfocus="(this.type='date')" onblur="(this.type='text')" name="date"> 
                <label for="stuff" class="fa fa-calendar input-icon"></label>
                </div>
                </td>
            </tr>
                   </table>

            
            <div class="upload2">
            <center><input type="text" name="user_address" placeholder="Enter your address here"></center>
            </div>
            
           <div class="upload2"> Profile Picture <input type="file" name="image" /> </div>
              
           <div id="upload2"> Upload Signature <input type="file" name="image2" /></div>
             
    
        <div class="check">
        <input type="checkbox" name="check_box"> Check this box for remember cookies   </div>  
        <input type="submit" name="submit" value="Register" class="button">
        <?php echo $message;?>
             
        </form>
    </fieldset>
        </div>
    </body>
    
    
</html>