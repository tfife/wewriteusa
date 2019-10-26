<?php
session_start();
require "dbConnect.php";
$db = get_db();

$doc = $_GET['doc'];
$user = $_GET['user'];

if ($user == $_SESSION['user_id']) {
    $statement = $db->prepare("DELETE FROM comment WHERE doc_id = $doc; DELETE FROM document WHERE doc_id = $doc");
    $statement->execute();
}

$location = $_SERVER['HTTP_REFERER'];
header("Location: $location");
?>