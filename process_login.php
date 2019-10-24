<?php
session_start();
require "dbConnect.php";
$db = get_db();

$username = $_POST['username'];
$username = $_POST['password'];

?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <link rel="stylesheet" type="text/css" href="wewrite_style.css">
    <meta charset="UTF-8">
    <title>Login WeWrite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Log in to your weWrite account">
</head>
<body>
    <?php echo "$username<br>$password"; ?>
</body>
</html>