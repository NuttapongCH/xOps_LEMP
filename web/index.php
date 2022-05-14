<?php 

 $servername = "db";
 $username = "root";
 $password = "sev1234";
 
 // Create connection
 $conn = new mysqli($servername, $username, $password);
 
 // Check connection
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }
 echo "Connected successfully";


?>