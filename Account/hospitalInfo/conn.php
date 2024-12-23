<?php
$db="ihcrs_database";
$password = "";
$con= new mysqli("localhost","root",$password,$db);
if($con->connect_error){
echo"error occured:" .  $conn->error;
}

?>