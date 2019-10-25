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
            background-color: rgb(120, 0, 75);
            color: white;
        }
        header {
            font-size: 4em;
        }
        h1 {
            font-size: 3em;
        }
        p {
            font-size: 2em;
        }
        button {
            font-size: 3em;
            height: 4em;
            background-color: snow;
            color: rgb(90, 0, 50);
            border: 2px solid lightgray;
        }

    </style>
</head>

<body>
    <header>WELCOME TO WE WRITE USA</header>
    <h1>Your account has been created successfully</h1>
    <p>Click the button to continue to your Dashboard and start writing!</p>
    <button onclick="window.location.href = 'dashboard.php';">Get Started</button>
</body>
</html>