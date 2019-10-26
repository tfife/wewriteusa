<?php
    session_start();

    //only allow access if login is accepted
    if(!($_SESSION[user_id])) {
        header("Location: login.php");
    }

    require "dbConnect.php";
    $db = get_db();

    $id = $_SESSION[user_id];
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <link rel="stylesheet" type="text/css" href="wewrite_style.css">
    <meta charset="UTF-8">
    <title>Favorite Documents</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View saved list of favorite docs">
</head>

<body>
    <div id="page_wrap">
        <?php include("menus.php")?>
        <div class="main_content">
            <?php

                echo "<h1 style='border-bottom: 1px dashed rgb(120, 0, 75)'>Favorite Documents</h1><br>";

                $statement = $db->prepare("SELECT doc_id FROM faveDoc WHERE user_id=$id");
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $fave = $row['doc_id'];

                    $statement2 = $db->prepare("SELECT doc_title, doc_sum, doc_id FROM document WHERE doc_id=$fave");
                    $statement2->execute();

                    while ($row2 = $statement2->fetch(PDO::FETCH_ASSOC)) {

                        $title = $row2['doc_title'];
                        $summary = $row2['doc_sum'];
                        $doc_id = $row2['doc_id'];
    
                        echo "<div class='card' style='position:relative'><a href='document.php?doc=$doc_id'><h2>$title</h2></a><p>$summary</p></div>";
                    }
                }

                $statement = $db->prepare("SELECT doc_title, doc_sum, doc_id FROM document WHERE doc_id=$fave");
                $statement->execute();

                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                    $title = $row['doc_title'];
                    $summary = $row['doc_sum'];
                    $doc_id = $row['doc_id'];
    
                    echo "<div class='card' style='position:relative'><a href='document.php?doc=$doc_id'><h2>$title</h2></a><p>$summary</p><a href= 'delete-document.php?user=$id&doc=$doc_id' style='position: absolute; right: 5px; top: 5px'>Delete Document</a></div>";
                }
            ?>
            <a href="doc-editor.php"><button class="create_doc">Create a Document</button></a>
        </div>
        <footer>
            Website created by Tori Fife. 10/2019.
        </footer>
    </div><!--page_wrap-->
</body>
</html>