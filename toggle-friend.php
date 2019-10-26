<?php
session_start();
require "dbConnect.php";
$db = get_db();
$id = $_SESSION[user_id];
$friend = $_GET['friend'];

$statement = $db->prepare("SELECT f_two FROM friends WHERE f_one = $id AND f_two = $friend");
$statement->execute();
$row = $statement->fetch(PDO::FETCH_ASSOC);
if($row['f_two']) {
    $statement = $db->prepare("DELETE FROM friends WHERE f_one = $id AND f_two = $friend");
    $statement->execute();
} else {
    $statement = $db->prepare("INSERT INTO friends VALUES($id, $friend)");
    $statement->execute();
}
$location = $_SERVER['HTTP_REFERER'];
header("Location: $location");

?>