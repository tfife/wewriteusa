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
    $statement = $db->prepare("SELECT display_name, profile.user_id, doc_title, doc_text FROM profile, document WHERE doc_id=$id AND profile.user_id = document.user_id");
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $title = $row['doc_title'];
    $content = $row['doc_text'];
    $user = $row['user_id'];
    $username = $row['display_name'];

    echo "<div class='card'><div style='text-align: center'><h2 style='text-align:>$title</h2><a href='profile.php?user=$user'><br>-$username-</a></div><br><p>$content</p></div>";

    echo"<div class='card'><h2>Comments</h2><br>";
    $statement = $db->prepare("SELECT display_name, comment_text, comment.user_id FROM profile, comment WHERE doc_id=$id AND comment.user_id = profile.user_id");
    $statement->execute();

    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $comment = $row['comment_text'];
            $user = $row['user_id'];
            $commenter = $row['display_name'];
            echo "<div class='com_card'><a href='profile.php?user=$user'>$commenter</a><p>$comment</p></div>";
        }
    echo "</div>";

?>
    </div>
    <footer>
        Website created by Tori Fife. 10/2019.
    </footer>

</body>
</html>