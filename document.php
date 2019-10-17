<?php
    session_start();
    require "dbConnect.php";
    $db = get_db();
    
    $id = $_GET['user'];
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <link rel="stylesheet" type="text/css" href="wewrite_style.css">
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View and Comment on a Document">
</head>

<body>
    <?php include("menus.php")?>


    <div class="main_content">


<?php 
    $statement = $db->prepare("SELECT display_name, document.user_id, doc_id, doc_title, doc_sum FROM profile, document WHERE profile.user_id = document.user_id; ");
    $statement->execute();
    // Go through each result
    $i = 0;
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) && $i < 10)
    {
        $title = $row['doc_title'];
        $summary = $row['doc_sum'];
        $content = $row['doc_text'];
        $id = $row['doc_id'];
        $user = $row['user_id'];
        $username = $row['display_name'];
        echo "<div class='card'><a href='document.php?doc=$id'><p><h2 style='display: inline'>$title</h2></a><a href='profile.php?user=$user' style='float: right'>-$username-</a><p>$summary</p></div>";
        $i++;
    }
    ?>
    $statement = $db->prepare("SELECT display_name, profile.user_id, doc_title, doc_text FROM profile, document WHERE doc_id=$id AND profile.user_id = document.user_id");
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $title = $row['doc_title'];
    $content = $row['doc_text'];
    $user = $row['user_id'];
    $username = $row['display_name'];

    echo "<div class='card'><div style='text-align: center'><h2>$title</h2><a href='profile.php?user=$user'><br>-$username-</a></div><br><p>$content</p></div>";

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