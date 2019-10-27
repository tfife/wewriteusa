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
            <a href="doc-editor.php"><button class="create_doc">Create a Document</button></a>

            <h2>Recent Documents</h2>
            <?php 
                $statement = $db->prepare("SELECT display_name, document.user_id, doc_id, doc_title, doc_sum FROM profile, document WHERE profile.user_id = document.user_id order by doc_id desc");
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

                    $fave = $db->prepare("SELECT doc_id FROM faveDoc WHERE doc_id = $id AND user_id = " . $_SESSION[user_id]);
                    $fave->execute();
                    $row2 = $fave->fetch(PDO::FETCH_ASSOC);
                    if ($row2['doc_id']) {
                        $heart = "<a href='toggle-heart.php?doc=$id' style='position:absolute; top: 5px; left: 5px'><img src='images/full_heart.png' alt='remove favorite' style='height: 20px; width: auto'></a>";
                    }
                    else {
                        $heart = "<a href='toggle-heart.php?doc=$id' style='position:absolute; top: 5px; left: 5px'><img src='images/open_heart.png' alt='add favorite' style='height: 20px; width: auto'></a>";
                    }

                    echo "<div class='card' style='position:relative'>$heart<a href='document.php?doc=$id'><p><h2 style='display: inline'>$title</h2></a><a href='profile.php?user=$user' style='float: right'>-$username-</a><p>$summary</p></div>";
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