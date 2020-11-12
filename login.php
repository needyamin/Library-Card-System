<?php 
session_start();
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

$sql = "SELECT * FROM student where email='$email' AND password='$password'";
$result = $conn->query($sql);

    
if ($result->num_rows > 0) {
// start session when logged in // 
    
while($row = $result->fetch_assoc()) {
$_SESSION['id'] = $row['id'];
$me = $row['id'];    
header("location: card.php?id=$me");   
  }
    
    
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
        <title> Library login</title>
        <link href="style.css" rel="stylesheet">
        
        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    
    <body>
        <div class="container">
      <fieldset id="fieldset"> <legend> <h2>Login Panel</h2></legend> 
    <form action="login.php" method="POST">
   
        <table class="Ltable">
        
        <tr><td>
            <div class="input-wrapper">
            <input type="text" name="email" placeholder="Enter your email">
            <label for="stuff" class="fa fa-user input-icon"></label>
            </div>
                </td> </tr>
            
        <tr><td>
            <div class="input-wrapper">
                <input type="password" name="password" placeholder="Enter your password"> 
             <label for="stuff" class="fa fa-key input-icon"></label>
            </div> </td></tr>

            
        <tr><td><input type="submit" name="submit" value="Login" class="btn">  <input type="button" onclick="window.location.href='signup.php'" value="Register" class="btn"></td> </tr>
        </table> 
        
       <?php  if(isset($message)){echo $message;}; if(isset($error)){echo $error;};?>
        
        <input type="button" class="admin" onclick="window.location.href='admin.php'" value="Admin Login">
        </form>
       
            </fieldset> </div>
    </body>
    
</html>
