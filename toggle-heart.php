<?php
session_start();
require "dbConnect.php";
$db = get_db();
$id = $_SESSION[user_id];
$doc = $_GET['doc'];

$statement = $db->prepare("SELECT doc_id FROM faveDoc WHERE doc_id = $doc AND user_id = $id");
$statement->execute();
$row = $statement->fetch(PDO::FETCH_ASSOC);
if($row['doc_id']) {
    $statement = $db->prepare("DELETE FROM faveDoc WHERE doc_id = $doc AND user_id = $id");
    $statement->execute();
    echo("Removed FaveDoc");
} else {
    $statement = $db->prepare("INSERT INTO faveDoc VALUES($id, $doc)");
    $statement->execute();
    $echo("Added FaveDoc");
}

?>