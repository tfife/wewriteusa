<?php
session_start();
require "dbConnect.php";
$db = get_db();

$id = $_SESSION[user_id];

$statement = $db->prepare("DELETE FROM profile WHERE user_id = $id");
$statement->execute();

header("Location: login.php");
?>