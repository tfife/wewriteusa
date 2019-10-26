<?php
session_start();
require "dbConnect.php";
$db = get_db();

$title = test_input($_POST['title'], ENT_QUOTES);
$content = test_input($_POST['content'], ENT_QUOTES);
$summary = test_input($_POST['summary'], ENT_QUOTES);
$user = $_SESSION[user_id];

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$statement = $db->prepare("INSERT INTO document(doc_title, doc_sum, doc_text, user_id) VALUES ('$title', '$summary', '$content', $user)");
$statement->execute();

header("Location: dashboard.php");
?>