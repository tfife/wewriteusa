<?php
session_start();
require "dbConnect.php";
$db = get_db();

$title = $_POST['title'];
$content = $_POST['content'];
$summary = $_POST['summary'];
$user = $_SESSION[user_id];

$statement = $db->prepare("INSERT INTO document(doc_title, doc_sum, doc_text, user_id) VALUES ('$title', '$summary', '$content', $user)");
$statement->execute();

header("Location: dashboard.php");
?>