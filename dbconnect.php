<?php
$serverName ="localhost";
$username= "root";
$password="";
$dbname="products";
$conn = new mysqli($serverName,$username,$password,$dbname);
if ($conn -> connect_error){
    die("Connection failed" . $conn -> connect_error);
}


?>