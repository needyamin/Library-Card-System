<!DOCTYPE html>
<html>
<head>
    <title>Admin DashBoard</title>
       <link href="style.css" rel="stylesheet">
        
        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    
<body>
    <h1> Edit Box</h1>
    <h3> Logged in as Admin! (<a href='logout.php'>logout </a>)</h3>
    
    
<?php 
include"engine/db.php";
$message= '';
$id = $_GET['edit'];

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
      
$sqlx = "UPDATE `student` SET `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email', `password` = '$password', `book` = '$borrow', `user_id` = '$user_id', `expire_date` = '$expire_date', `user_address` = '$user_address', `profile_pic` = '$file_name', `signature` = '$file_name2', `check_box` = '$check_box', `datenow` = '$datenow' WHERE `student`.`id` = $id;";

    
 //collect data to session
if ($conn->query($sqlx) === TRUE) {
$message= "Your Information updated successfully";

//path
$path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$path .=$_SERVER["SERVER_NAME"]. dirname($_SERVER["PHP_SELF"]);
    
//Javascript redirect after 5 sec 
echo $success ="<script>
         setTimeout(function(){
            window.location.href = '$path/admindashboard.php';
         }, 5000);
      </script>";    
} else {
  $message= "Something is wrong. Please contact admin.. <br>" . $conn->error;
}
    
$conn->close();
   
    
    


//checking data end    
}

;?>

        
        
<?php
include"engine/db.php";
session_start();

//check GET signal and delete message    
@$deleted = $_GET['deleted'];
if(isset($_GET['deleted'])){
  echo $fuck ="<script>alert('User has been deleted')</script>";  
};
    
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM student where id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// start session when logged in // 
    
while($row = $result->fetch_assoc()) {;?>
    
        
    
    
    
           <?php echo $message;?>
       <form action="" method="POST" enctype="multipart/form-data">
        <center><table class="Rtable">    
        <tr><td>
            <div class="input-wrapper">
            <input type="text" name="firstname" placeholder="First Name" value="<?php echo $row['firstname'];?>" required> 
            <label for="stuff" class="fa fa-address-card-o input-icon"></label>
                </div>
            </td>
            <td>
            <div class="input-wrapper">
            <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $row['lastname'];?>" required>
            <label for="stuff" class="fa fa-address-card-o input-icon"></label>
                </div>
            </td></tr>
            
            
            <tr><td>
                <div class="input-wrapper">
                <input type="email" name="email" placeholder="example@website.com" value="<?php echo $row['email'];?>" required>
                <label for="stuff" class="fa fa-envelope-o input-icon"></label>
                </div>
                </td>
                
             <td>
                 <div class="input-wrapper">
                 <input type="text" name="borrow" placeholder="Borrow Book" value="<?php echo $row['book'];?>" required>
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
                <input type="number" name="user_id" placeholder="User ID" value="<?php echo $row['user_id'];?>" required>
                <label for="stuff" class="fa fa-user input-icon"></label>
                </div>
                </td>
                
                
             
                
            </tr>
         
            
            <tr>
                <td>
                <div class="input-wrapper">
                <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo @$row['confirm_password'];?>">
                <label for="stuff" class="fa fa-key input-icon"></label>
                </div>
                </td>
                
            <td>
                <div class="input-wrapper">
                <input type="text" placeholder="Expiry Date" onfocus="(this.type='date')" onblur="(this.type='text')" name="date" value="<?php echo $row['expire_date'];?>"> 
                <label for="stuff" class="fa fa-calendar input-icon"></label>
                </div>
                </td>
            </tr> 
            
            
                   </table> 

            
            <div class="upload2" style="width:48%;">
            <center><input type="text" name="user_address" placeholder="<?php echo $row['user_address'];?>"></center>
            </div>
            
            <div class="upload2" style="width:48%;"> Profile Picture <input type="file" name="image" /> </div>
              
            <div class="upload2" style="width:48%;"> Upload Signature <input type="file" name="image2" /></div>
   
        <input type="submit" name="submit" value="Update" class="button" style="width:51%;">  </center>

             
        </form>
        
    <?php }};?>

    
    
</body>    

</html>