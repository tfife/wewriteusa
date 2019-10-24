<?php
session_start();
require "dbConnect.php";
$db = get_db();

$username = $_POST['username'];
$username = $_POST['password'];
echo "$username<br>$password";
?>