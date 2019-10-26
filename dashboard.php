<?php
    session_start();
    require "dbConnect.php";
    $db = get_db();

    if(!($_SESSION[user_id])) {
        header("Location: login.php");
    }
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
    <div id="page_wrap">
        <?php include("menus.php")?>
        <div class="main_content">
            <button class="create_doc" href="doc-editor.php">Create a Document</button>

            <h2>Recent Documents</h2>
            <?php 
                $statement = $db->prepare("SELECT display_name, document.user_id, doc_id, doc_title, doc_sum FROM profile, document WHERE profile.user_id = document.user_id order by profile.user_id desc");
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
        </div><!--main_content-->
        <footer>
            Website created by Tori Fife. 10/2019.
        </footer>
    </div><!--page_wrap-->
</body>
</html>