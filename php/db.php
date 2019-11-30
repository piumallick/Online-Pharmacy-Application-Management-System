<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/


$con = mysqli_connect("localhost","root","root","ONLINE_DATABASE_PHARMACY",);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
