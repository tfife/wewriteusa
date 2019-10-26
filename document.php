<?php
    session_start();

    if(!($_SESSION[user_id])) {
        header("Location: login.php");
    }

    require "dbConnect.php";
    $db = get_db();
    $id = $_GET['doc'];
    $user = $_SESSION[user_id];
    $comment = '';
    $good = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['comment'])) {
            $good = false;
        } else {
            $comment = pg_escape_string(test_input($_POST['comment']));
        }

        if ($good == true) {

            $statement = $db->prepare("INSERT INTO comment(comment_text, user_id, doc_id) VALUES ('$comment', $user, $id)");
            $statement->execute();
        }
    }

    function test_input($data) {
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
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View and Comment on a Document">
</head>

<body>
    <div id="page_wrap">
        <?php include("menus.php")?>
        <div class="main_content">
            <?php 
                
                $statement = $db->prepare("SELECT display_name, profile.user_id, doc_title, doc_text FROM profile, document WHERE doc_id=$id AND profile.user_id = document.user_id");
                $statement->execute();

                $row = $statement->fetch(PDO::FETCH_ASSOC);

                $title = $row['doc_title'];
                $content = $row['doc_text'];
                $commenter = $row['user_id'];
                $username = $row['display_name'];

                echo "<div class='card'><div style='text-align: center'><h2>$title</h2><a href='profile.php?user=$user'><br>-$username-</a></div><br><p>$content</p></div>";

                echo"<div class='card'><h2>Comments</h2><br>";
                $statement = $db->prepare("SELECT display_name, comment_text, comment_id, comment.user_id FROM profile, comment WHERE doc_id=$id AND comment.user_id = profile.user_id");
                $statement->execute();

                while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                    {
                        $comment = $row['comment_text'];
                        $comment_id = $row['comment_id'];
                        $user_id = $row['user_id'];
                        $commenter = $row['display_name'];
                        echo "<div class='com_card' style='position:relative'><a href='profile.php?user=$user_id'>$commenter</a><p>$comment</p>";
                        if ($user == $user_id) {
                            echo "<a href= 'delete-comment.php?user=$user_id&?comment=$comment_id&?return=\"" . htmlspecialchars($_SERVER['PHP_SELF'] . "?doc=$id\")><button type='submit' style='width: 30px; height: 30px border: 1px solid gray; position: absolute; right: 0; top: 0'>X</button></a>";
                        }
                        echo "</div>";
                    }
                ?>
                    <div class='com_card'>
                        <form id="post_comment" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?doc=$id");?>" method="post">
                            <label>Add Comment: </label>
                        </form>
                        <textarea form="post_comment" name="comment" required></textarea>
                        <br>
                        <button type="submit" form="post_comment">Post</button>
                    </div>
                </div>

        </div>
        <footer>
            Website created by Tori Fife. 10/2019.
        </footer>
    </div><!--page_wrap-->
</body>
</html>