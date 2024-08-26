<?php 

session_start();

define("ROOT_URL", "http://localhost/foodie/");

$DBHOST = "localhost";
$DBUSER = "root";
$DBPASS = "";
$DBNAME = "foodie";

$conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}