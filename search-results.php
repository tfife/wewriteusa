<?php
    session_start();
    require "dbConnect.php";
    $db = get_db();

    $search = "";
    $good = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["search_string"])) {
                $_SESSION[search_string] = "";
                $good = false;
            } else {
                $_SESSION[search_string] = canonicalize($_POST["search_string"]);
                $search = $_SESSION[search_string];
            }
    }
    
    function canonicalize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <link rel="stylesheet" type="text/css" href="wewrite_style.css">
    <meta charset="UTF-8">
    <title>Search Results WeWriteUSA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Results for search">
</head>

<body>
    <div id="page_wrap">
        <?php include("menus.php")?>
        <div class="main_content">
            
            <?php
            echo("Your search: \"" . $search . "\"");
                if ($good == false || $search == "") {
                    echo("<h2>Invalid Search content</h2>");
                }

                else {
                    //Users
                    $statement = $db->prepare("SELECT display_name, user_id, FROM profile WHERE display_name LIKE '$search'");
                    $statement->execute();
                    
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                    {
                        $name = $row['display_name'];
                        $user = $row['user_id'];
                        echo"<div class='card'><a href='profile.php?user=$user'><h2>$name</h2></a><br>";
                        /*$s2 = $db->prepare("SELECT doc_title, doc_id FROM document WHERE user_id = $user");
                        $s2->execute();
                        echo "<h3>Documents: </h3>";
                        while($row2 = $s2->fetch(PDO::FETCH_ASSOC)) {
                            $doc = $row2['doc_title'];
                            $doc_id = $row2['doc_id'];
                            echo "<div><a href='document.php?id=$doc_id'>$doc_title</a></div>, ";
                        }*/
                        echo "</div>";
                    }
                    $row = $statement->fetch(PDO::FETCH_ASSOC);





                }


            ?>

            <?php/*
                $statement = $db->prepare("SELECT display_name, profile.user_id, doc_title, doc_sum FROM profile, document WHERE doc_id=$id");
                $statement->execute();

                $row = $statement->fetch(PDO::FETCH_ASSOC);

                $name = $row['display_name'];
                $title = $row['doc_title'];
                $summary = $row['doc_sum'];
                echo "<h1>$name</h1><br>";
                echo "<h2>Documents</h2>";
                echo "<div class='card'><a href='document.php?doc=$id'><h2>$title</h2></a><p>$summary</p></div><br>";

                echo "<h2>Comments</h2>";

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
*/
            ?>
        </div>
        <footer>
            Website created by Tori Fife. 10/2019.
        </footer>
    </div><!--page_wrap-->
</body>
</html>