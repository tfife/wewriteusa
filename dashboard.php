<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="wewrite_style.css">
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View your information for wewrite account">
</head>

<body>
    <div class="row">
        <div class="col-xl-12">
            <header>
                <?php include("navbar.php")?>
            </header>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3" style="background-color: gray; text-align: right">
            here is my sidebar
        </div>
        <div class="col-md-6">
            here is all the other content
            <footer>
                Website created by Tori Fife. 10/2019.
            </footer>
        </div>
        <div class="col-md-3" style="background-color: gray">
            here is my other sidebar
        </div>

    </div>


</body>
</html>