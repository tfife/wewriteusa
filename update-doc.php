<?php
session_start();
require "dbConnect.php";
$db = get_db();

$title = pg_escape_string(test_input($_POST['title']));
$content = pg_escape_string(test_input($_POST['content']));
$summary = pg_escape_string(test_input($_POST['summary']));
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