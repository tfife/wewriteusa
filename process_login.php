<?php
session_start();
require "dbConnect.php";
$db = get_db();

$username = $_POST['username'];
$password = $_POST['password'];

$statement = $db->prepare("SELECT user_id, username, password FROM profile WHERE username = '$username' AND password = '$password'");
$statement->execute();
//if we have a match, set session variables and redirect to dashboard
$row = $statement->fetch(PDO::FETCH_ASSOC);
if($row) {
    $_SESSION[user_id] = $row[user_id];
    $_SESSION[username] = $username;
    $_SESSION[password] = $password;
    header("Location: dashboard.php");
}
//otherwise go back to login and display error
else {
    header("Location: login.php?error=1");
}
?>