<?php
$server="localhost";
$user="root";
$pass="";
$db="ihcrs_database";

$conn=mysqli_connect($server,$user,$pass,$db);
if(!$conn){
    echo "connection failed";
}




?>