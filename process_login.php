<?php
session_start();
require "dbConnect.php";
$db = get_db();

$username = $_POST['username'];
$password = $_POST['password'];

$statement = $db->prepare("SELECT user_id, username, password FROM profile WHERE username = '$username'");
$statement->execute();
//if we have a user, check the password and then (if it's good) set session variables and redirect to dashboard
$row = $statement->fetch(PDO::FETCH_ASSOC);
if($row) {
    $hash = $row[password];
    if(password_verify($password, $hash)) {
        $_SESSION[user_id] = $row[user_id];
        $_SESSION[username] = $username;
        header("Location: dashboard.php");
    }
}

//otherwise go back to login and display error
header("Location: login.php?error=1");
?>