<?php
    session_start();

    //only allow access if login is accepted
    if(!($_SESSION[user_id])) {
        header("Location: login.php");
    }

    require "dbConnect.php";
    $db = get_db();

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

                echo "<h1 style='border-bottom: 1px dashed rgb(120, 0, 75)'>$name</h1><br>";

                if ($id == $_SESSION[user_id]) {
                    $possessive = "My";
                }
                else {
                    $possessive = "$name's";
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