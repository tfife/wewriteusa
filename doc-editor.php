<?php
    session_start();

    //only allow access if login is accepted
    if(!($_SESSION[user_id])) {
        header("Location: login.php");
    }

    require "dbConnect.php";
    $db = get_db();
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
            <form id="doc_editor" action="update-doc.php" method="post" style="text-align: center">
                <h3>Edit Content, then Hit Submit!</h3>
                <label>Document Title:</label>
                <input type="text" name="title" required>
            </form>
            <label>Summary:</label><br>
            <textarea name="summary" form="doc_editor" style="width: 90%; height: 20vh" required></textarea>
            <label>Content:</label><br>
            <textarea name="content" form="doc_editor" style="width: 90%; height: 40vh" required></textarea>
            <br>
            <button type="submit" form="doc_editor">Submit!</button>
        </div>
        <footer>
            Website created by Tori Fife. 10/2019.
        </footer>
    </div><!--page_wrap-->
</body>
</html>