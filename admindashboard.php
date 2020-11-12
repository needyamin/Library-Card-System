<!DOCTYPE html>
<html>
<head>
    <title>Admin DashBoard</title>
       <link href="style.css" rel="stylesheet">
        
        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    

    
<body>
    <h1> Welcome in Admin Panel</h1>
    <h3> Logged in as Admin! (<a href='logout.php'>logout </a>)</h3>
    
    

<table border="2px" style="text-align:center;"> 
    
    


<tr>
<th>Name</th>
<th>Email</th>
<th>Book</th>
<th>Reqister Date</th>
<th>Expire Date</th>
<th>User Id</th>
<th>User Address</th>
<th> </th>    
</tr>  
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

$sql = "SELECT * FROM student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// start session when logged in // 
    
while($row = $result->fetch_assoc()) {;?>
    
    
    <tr>
             <td style="width:200px;"> <?php echo $row['firstname'];?> <?php echo $row['lastname'];?></td>
             <td style="width:200px;"> <?php echo $row['email'];?></td>
             <td> <?php echo $row['book'];?></td>
             <td> <?php echo $row['datenow'];?></td>
             <td> <?php echo $row['expire_date'];?></td>
             <td> <?php echo $row['user_id'];?></td>
             <td> <?php echo $row['user_address'];?></td>
             <td> 
            <a href="edit.php?edit=<?php echo $row['id'];?>">edit</a> 
            <a href="del.php?del=<?php echo $row['id'];?>">del</a>
             </td>
     
    </tr>
    
    <?php }};?>
        
        
          
    </table>
    
    
</body>    

</html>