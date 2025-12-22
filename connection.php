<?php

$dbhost = "localhost"; 
$dbname = "dolphin_crm"; 
$dbuser = "root"; 
$dbpass = ""; 

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 

if(!$conn){
    die("Connection failed. Reason: " . mysqli_connect_error());
}