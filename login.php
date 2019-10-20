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
    <title>Login WeWrite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Log in to your weWrite account">
    <style>
        body {
            background-color: rgb(90, 0, 50);
            color: white;
        }
        #login_grid {
            display: grid;
            grid-template-areas:
                'banner banner'
                'header form'
                'promo form';
        }
        #banner {
            grid-area: banner;
            background-color: snow;
            color: rgb(120, 0, 75);
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        header { grid-area: header; }
        #create_account { grid-area: form; }
        #promo {
            grid-area: promo;
            font-size: 20px;
            padding: 20%;
        }
    </style>
</head>

<body>
    <div id="login_grid">
        <header><h1>Create an Account</h1>Write and help others Write. That's Right!</header>
        <div id="banner">
            <img src="images/name_color.png" alt="WeWriteUSA">
            <div>Already have an account? Log in here!</div>
            <div>Username: <input type=text placeholder="This does nothing"></div>
            <div>Password: <input type=text placeholder="This does nothing"></div>
        </div><!--banner-->
        <div id="create_account">
            <div>THIS WILL LATER HAVE STUFF FOR CREATING AN ACCOUNT</div>
        </div><!--create_account-->
        <div id="promo">
            <p>Post text that you would like to reviewed by our community of over 2 users!</p>
            <p>Give helpful feedback to friends.</p>
        </div><!--promo-->
    </div><!--login_grid-->
</body>
</html>