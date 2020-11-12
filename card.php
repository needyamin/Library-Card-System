<?php
include"engine/db.php";
session_start();
$id = $_GET['id'];

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM student where id='$id'";
$result = $conn->query($sql);

    
if ($result->num_rows > 0) {
// start session when logged in // 
    
while($row = $result->fetch_assoc()) {;?>

<!DOCTYPE html>
<html>
<head>
    <title> Welcome to Library Dashboard</title>
      <link href="style.css" rel="stylesheet">
        
        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

<body>
<div class="container">
    
      <fieldset> <legend id="legend"> <h2>Card Info</h2></legend>  
          
<img src="images/<?php echo $row['profile_pic'];?>" class="imgcenter">

<table align="center"> 
    <tr> <td> Card Number:  </td> <td> <?php echo $row['id'];?></td></tr>
    <tr> <td> User Name:  </td> <td > <?php echo $row['firstname'];?> <?php echo $row['lastname']?></td></tr>
      <tr> <td> User ID:  </td> <td> <?php echo $row['user_id'];?></td></tr>
      <tr> <td> Borrow Book:  </td> <td> <?php echo $row['book'];?></td></tr>
      <tr> <td> Issued Date:  </td> <td> <?php echo $row['datenow'];?></td></tr>
      <tr> <td> Expiry Date:  </td> <td> <?php echo $row['expire_date'];?></td></tr>
    <tr> <td> User Address:  </td> <td> <?php echo $row['user_address'];?></td></tr>
    
      <tr> <td> Signuture: </td><td><img src="images/<?php echo $row['signature'];?>" class="signuture"></td></tr>
    
    </table>
          
        <?php  }};?>  
          <button onclick="window.print()" class="center">Print this page</button>

      </fieldset>
          
    
    
</div>
    
    
    </body>
    
    
</html>