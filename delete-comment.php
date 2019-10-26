<?php
session_start();
require "dbConnect.php";
$db = get_db();

$comment = $_GET['comment'];
$user = $_GET['user'];

if ($user == $_SESSION['user_id']){
    $statement = $db->prepare("DELETE FROM comment WHERE comment_id = $comment AND user_id = $user");
    $statement->execute();
}

header("Location: document.php");
?>