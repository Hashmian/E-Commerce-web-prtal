<?php
 $server="localhost";
 $user="root";
 $pass="";
 $databse="e -shop-db";
 $conn=new mysqli($server,$user,$pass,$databse);
 if($conn->connect_error){
    die("connection is failed" .$conn->connect_error);
 }
?>