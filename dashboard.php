<?php
    session_start();
    require "dbConnect.php";
    $db = get_db();
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
    <?php include("menus.php")?>


    <div class="main_content">
        <?php 
            $statement = $db->prepare("SELECT display_name, document.user_id, doc_id, doc_title, doc_sum FROM profile, document WHERE profile.user_id = document.user_id; ");
            $statement->execute();
            // Go through each result
            $i = 0;
            while (($row = $statement->fetch(PDO::FETCH_ASSOC)) && $i < 10)
            {
                $title = $row['doc_title'];
                $summary = $roy['doc_sum'];
                $content = $row['doc_text'];
                $id = $row['doc_id'];
                $user = $row['user_id'];
                $username = $row['display_name'];
                echo "<div class='card'><a href='document.php?doc=$id'><p><strong>$title </strong></a>-<a href='profile.php?user=$user' style='float: right'>$username</a><p>$summary</p></div>";
                $i++;
            }
        ?>
    </div>
    <footer>
        Website created by Tori Fife. 10/2019.
    </footer>

</body>
</html>