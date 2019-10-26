<?php
    session_start();

    //only allow access if login is accepted
    if(!($_SESSION[user_id])) {
        header("Location: login.php");
    }

    require "dbConnect.php";
    $db = get_db();

    $self = $_SESSION[user_id];

    if($_GET['user']) {
        $id = $_GET['user'];
    }
    else {
        $id = $_SESSION[user_id];
    }
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <link rel="stylesheet" type="text/css" href="wewrite_style.css">
    <meta charset="UTF-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View a user's information for wewrite account">
</head>

<body>
    <div id="page_wrap">
        <?php include("menus.php")?>
        <div class="main_content">
            <?php
            
                $statement = $db->prepare("SELECT display_name FROM profile WHERE user_id = $id");
                $statement->execute();

                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $name = $row['display_name'];
                $friend = false;
                if ($self != $id) {
                    $statement = $db->prepare("SELECT f_two FROM friends WHERE f_one = $self AND f_two = $id");
                    $statement->execute();
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    if ($row['f_two']) {
                        $friend = true;
                    }
                }
                echo "<h1 style='border-bottom: 1px dashed rgb(120, 0, 75) position: relative;'>$name";
                if ($self != $id) {
                    if ($friend == true) {
                        echo "<span style='font-size: 16; position: absolute; top: 5px; right: 5px'><a href='toggle-friend.php?friend=$id'>Add Friend</a></span>";
                    } else {
                        echo "<span style='font-size: 16; position: absolute; top: 5px; right: 5px'><a href='toggle-friend.php?friend=$id'>Remove From Friends</a></span>";
                    }
                }
                    ;
                echo "</h1><br>";

                if ($id == $_SESSION[user_id]) {
                    $possessive = "My";
                }
                else {
                    $possessive = "$name\'s";
                }
                
                echo "<h2>$posessive Documents</h2>";

                $statement = $db->prepare("SELECT doc_title, doc_sum, doc_id FROM document WHERE user_id=$id");
                $statement->execute();

                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                    $title = $row['doc_title'];
                    $summary = $row['doc_sum'];
                    $doc_id = $row['doc_id'];
    
                    echo "<div class='card'><a href='document.php?doc=$doc_id'><h2>$title</h2></a><p>$summary</p></div>";
    
                }

                echo "<h2>$posessive Comments</h2>";
                $statement = $db->prepare("SELECT display_name, document.user_id,  doc_title, comment_text FROM profile, document, comment WHERE comment.user_id = $id AND comment.doc_id = document.doc_id AND document.user_id = profile.user_id;");
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                    {
                        $doc_title = $row['doc_title'];
                        $author = $row['display_name'];
                        $user = $row['user_id'];
                        $comment = $row['comment_text'];
                        echo"<div class='card'><a href='document.php?doc=$id'><h3>$doc_title</h3></a><a href='profile.php?user=$user'>-$author-</a><br>";
                        echo "<div class='com_card'><p>$comment</p></div>";
                        echo "</div>";
                    }

            ?>
        </div>
        <footer>
            Website created by Tori Fife. 10/2019.
        </footer>
    </div><!--page_wrap-->
</body>
</html>