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
    <title>Friends List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="See all your best friends in one place">
</head>

<body>
    <div id="page_wrap">
        <?php include("menus.php")?>
        <div class="main_content">
            <?php

                echo "<h1 style='border-bottom: 1px dashed rgb(120, 0, 75)'>Friends List</h1><br>";

                echo "<h2>Your Friends</h2><br>";
                $statement = $db->prepare("SELECT f_two FROM friends WHERE f_one=$id");
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $friend = $row['f_two'];

                    $statement2 = $db->prepare("SELECT display_name FROM profile WHERE user_id = $friend");
                    $statement2->execute();
                    $row2 = $statement2->fetch(PDO::FETCH_ASSOC);
                    $friend_name = $row2['display_name'];
    
                    echo "<div class='card' style='position: relative'><a href='profile.php?id=$friend'><h2>$friend_name</h2></a><a href='toggle-friend.php?friend=$friend' style='position:absolute; top:5px; right: 5px'>Remove From Friends</a></div>";
                }

                echo "<h2>Friends With You</h2><br>";
                $statement = $db->prepare("SELECT f_one FROM friends WHERE f_two=$id");
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $friend = $row['f_one'];

                    $statement2 = $db->prepare("SELECT display_name FROM profile WHERE user_id = $friend");
                    $statement2->execute();
                    $row2 = $statement2->fetch(PDO::FETCH_ASSOC);
                    $friend_name = $row2['display_name'];

                    $statement2 = $db->prepare("SELECT f_two FROM friends WHERE f_one = $id");
                    $statement2->execute();
                    $row2 = $statement2->fetch(PDO::FETCH_ASSOC);
    
                    echo "<div class='card' style='position: relative'><h2><a href='profile.php?user=$friend'>$friend_name</a>";
                    if($row2['f_two']){
                        echo "<span><img src='images/star.png' alt='friend' style='height:20px; width:auto'></span><span style='position:absolute; top:5px; right: 5px'>Friends!</span>";
                    } else {
                        echo "<a href='toggle-friend.php?friend=$friend' style='position:absolute; top:5px; right: 5px'>Add Friend</a>";
                    }
                    echo "</h2></div>";
                }
            ?>
        </div>
        <footer>
            Website created by Tori Fife. 10/2019.
        </footer>
    </div><!--page_wrap-->
</body>
</html>