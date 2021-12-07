<?php
/* Database connection start */
$servername = "showdeedb.cipqx10duwv3.us-east-2.rds.amazonaws.com";
$username = "ShowdeeMaster";
$password = "wogusdla1!";
$dbname = "showdeerocks";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>