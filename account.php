<?php
    session_start();

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
    <title>Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Account Information">
</head>

<body>
    <div id="page_wrap">
        <?php include("menus.php")?>
        <div class="main_content">
            <div class="card">
                <?php
                    $statement = $db->prepare("SELECT username, display_name FROM profile WHERE user_id = $id");
                    $statement->execute();
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    $username = $row['username'];
                    $display_name = $row['display_name'];
                    echo "<p>Username: $username</p><p>Display Name: $display_name</p><p>Password: $password</p><br><p><a href='delete_warning.php'>Delete Account</a></p>";
                ?>
            </div>
        </div>
        <footer>
            Website created by Tori Fife. 10/2019.
        </footer>
    </div><!--page_wrap-->
</body>
</html>