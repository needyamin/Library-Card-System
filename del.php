<?php
include"engine/db.php";
session_start();

$id = $_GET['del'];

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM `student` WHERE `student`.`id` =$id";
$result = $conn->query($sql);
header('location: admindashboard.php?deleted=done');


?>