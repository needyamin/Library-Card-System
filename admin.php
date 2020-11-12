
<?php 
session_start();
//print_r($_POST);
include_once"engine/db.php";
$message ="";    
if(isset($_POST['submit'])){
    
$email = $_POST['email'];
$password = $_POST['password'];
$password = md5($password);     
    
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM admin where email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// start session when logged in //    
$_SESSION['email'] = $_POST['email'];
$_SESSION['id'] = $row['id']; 
header('location: admindashboard.php');   
    
// if fields empty //    
if((email == '') or ($password == '')){
   $message = "Please fill up all field";
}        
      
} 

 else{
 $error ="Incorrect info"; 
 }   

}

$conn->close();?>



<!DOCTYPE html>
<html>
    <head>
        <title> Admin login</title>
        <link href="style.css" rel="stylesheet">
        
        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    
    <body>
        <div class="container">
      <fieldset id="fieldset"> <legend> <h2>Admin Panel</h2></legend> 
          
    <form action="" method="POST">
   
        <table class="Admintable">
        
        <tr><td>
            <div class="input-wrapper">
            <input type="text" name="email" placeholder="admin name">
            <label for="stuff" class="fa fa-user input-icon"></label>
            </div>
                </td> </tr>
            
        <tr><td>
            <div class="input-wrapper">
                <input type="password" name="password" placeholder="admin password"> 
             <label for="stuff" class="fa fa-key input-icon"></label>
            </div> </td></tr>

            
        <tr><td><input type="submit" name="submit" value="Login" class="btn"> </tr>
        </table> 
         <?php  if(isset($message)){echo $message;}; if(isset($error)){echo $error;};?>
        <input type="button" class="admin" onclick="window.location.href='login.php'" value="User Login">
        
        </form> 
       
            </fieldset> </div>
        
        
    </body>
    
</html>