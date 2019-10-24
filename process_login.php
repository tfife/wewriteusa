<?php
session_start();
require "dbConnect.php";
$db = get_db();

$username = $_POST['username'];
$password = $_POST['password'];

$statement = $db->prepare("SELECT username, password FROM profile WHERE username = $username AND password = $password");
$statement->execute();
if($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo $row['username'] . "<br" . $row['password'];
}

echo "$username<br>$password";
?>