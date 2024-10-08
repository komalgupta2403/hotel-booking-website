<?php

$hostname = 'localhost';
$username = 'root';
$password = ''; // Add your password here if any
$database = 'hbwebsite';

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $database);
 
if (!$conn) {
  die("Connection failed: " .mysqli_connect_error());
}

 function filteration($data)
 {
   foreach($data as $key => $value){
     $data[$key] = trim($value);
     $data[$key] = stripslashes($value);
     $data[$key] = htmlspecialchars($value);
     $data[$key] = strip_tags($value);
    }
   return $data;
 }
 
 function select($sql,$values,$datatypes)
 {
   $conn = $GLOBALS['conn'];
   if($stmt = mysqli_prepare($conn,$sql))
   {
     mysqli_stmt_bind_param($stmt, $datatypes,...$values);
     if(mysqli_stmt_execute($stmt)){
       $res = mysqli_stmt_get_result($stmt);
       mysqli_stmt_close($stmt);
       return $res;
     }
     else{
       mysqli_stmt_close($stmt);
       die("Query cannot be executed - Select");
     }
   }
   else{
     die("Query cannot be prepared - Select");
   }
 }
?>