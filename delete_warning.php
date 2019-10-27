<?php
    session_start();

    if(!($_SESSION[user_id])) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <link rel="stylesheet" type="text/css" href="wewrite_style.css">
    <meta charset="UTF-8">
    <title>Welcome to WeWrite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to your new WeWrite Account">
    <style>
        body {
            background-color: white;
            color: black;
            text-align: center;
        }
        header {
            font-size: 3em;
            margin-top: 1em;
        }
        p {
            font-size: 2em;
        }
        button {
            font-size: 2em;
            height: 3em;
            background-color: red;
            color: white;
            border: 2px solid gray;
            margin-top: 2em;
        }

    </style>
</head>

<body>
    <header>Delete Account Confirmation</header>
    <p>Are you sure you want to delete your account? <span style="color: red">This action CANNOT be undone!</span></p>
    <button onclick="window.location.href = 'delete_account.php';">Delete Account</button>
</body>
</html>