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
        <div class="card">
            <?php 
                $statement = $db->prepare("SELECT doc_id, doc_title, doc_text, user_id FROM document");
                $statement->execute();
                // Go through each result
                for ($i = 0; $i < 10; $i++)
                {
                    $row = $statement->fetch(PDO::FETCH_ASSOC);

	                $title = $row['doc_title'];
	                $content = $row['doc_text'];
	                $id = $row['id'];
                    $user = $row['user'];
	                echo "<p><strong>$title </strong> - $user<p>";
                }
            ?>
        </div>
    </div>
    <div class="sidebar2">This will be another sidebar!</div>
    <footer>
        Website created by Tori Fife. 10/2019.
    </footer>

    </div>


</body>
</html>