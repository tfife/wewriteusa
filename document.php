<?php
    session_start();
    require "dbConnect.php";
    $db = get_db();
    
    $id = $_GET['doc'];
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <link rel="stylesheet" type="text/css" href="wewrite_style.css">
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View your information for wewrite account">
</head>

<body>
    <?php include("menus.php")?>


    <div class="main_content">


<?php
    $statement = $db->prepare("SELECT doc_title, doc_text, user_id FROM document WHERE doc_id=$id");
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $title = $row['doc_title'];
    $content = $row['doc_text'];
    $user = $row['user_id'];

    echo "<div class='card'><h2>$title</h2><a href='profile.php?user=$user' style='text-decoration: none'>$user</a><br><p>$content</p></div>";

    echo"<div class='card'><h2>Comments</h2><br>";
    $statement = $db->prepare("SELECT comment_text, user_id FROM comment WHERE doc_id=$id");
    $statement->execute();

    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $comment = $row['comment_text'];
            $commenter = $row['user_id'];
            echo "<div class='com_card'><a href='profile.php?user=$commenter' style='text-decoration: none'>$commenter</a><p>$comment</p></div>";
        }
    echo "</div>";

?>
    </div>
    <footer>
        Website created by Tori Fife. 10/2019.
    </footer>

</body>
</html>