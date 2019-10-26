<?php
session_start();
require "dbConnect.php";
$db = get_db();

$doc = $_GET['comment'];
$user = $_GET['user'];

if ($user == $_SESSION['user_id']) {
    $statement = $db->prepare("DELETE FROM document WHERE doc_id = $doc AND user_id = $user");
    $statement->execute();
}

$location = $_SERVER['HTTP_REFERER'];
header("Location: $location");
?>