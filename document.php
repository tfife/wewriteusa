<?php
    session_start();
    require "dbConnect.php";
    $db = get_db();
    
    $id = $_GET['id'];

    $statement = $db->prepare("SELECT doc_title, doc_text, user_id FROM document WHERE doc_id=$id");
    $statement->execute();
    // Go through each result
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $title = $row['doc_title'];
    $content = $row['doc_text'];
    $user = $row['user_id'];

    echo "<div class='card'><h2>$title</h2>-<a href='profile.php?user=$user' style='text-decoration: none'>$user</a><br><p>$content</p></div>";
    
?>