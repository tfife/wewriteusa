<?php
    session_start();
    if($_SESSION[username] && $_SESSION[password]) {
        header('Location: dashboard.php');
    }
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
            justify-content: space-between;
            align-items: baseline;
            min-height: 60px;
            padding: 0 20px;
        }
        header {
            grid-area: header;
            padding: 20%;
            font-size: 32px;
        }
        #create_account {
            grid-area: form;
            margin-top: 10vh;
            margin-bottom: 10vh;
            padding: 10vh 30px;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            border-left: 2px dotted white;
        }
        #create_account div {
            margin: 10px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: baseline;
            justify-content: space-between;
        }
        #create_account button {
            margin: 20px;
        }
        #promo {
            grid-area: promo;
            font-size: 20px;
            padding: 20%;
        }
        h1 {
            font-size: 46px;
        }
    </style>
</head>

<body>
    <div id="login_grid">
        <header><h1>Create an Account</h1>Write and help others Write. That's Right!</header>
        <div id="banner">
            <img src="images/name_color.png" alt="WeWriteUSA" style="height: 40px; width: auto">
            <div>Already have an account? Log in here!</div>
            <form method="post" action = "process_login.php">
                <label>Username:</label><input type=text name="username" value= <?php echo "\"" . $_SESSION[username] . "\"" ?> placeholder="Enter Username">
                <label>Password:</label><input type=text name="password" value= <?php echo "\"" . $_SESSION[username] . "\"" ?> placeholder="Enter Password">
            </form>
            <button>Login</button>
        </div><!--banner-->
        <div id="create_account">
            <div><div>Username:</div><div><input type=text id="username" name="username" placeholder="This does nothing"></div></div>
            <div><div>DisplayName:</div><div><input type=text id="display_name" name="display_name" placeholder="This does nothing"></div></div>
            <div><div>Password:</div><div><input type=text id="password" name="password" placeholder="This does nothing"></div></div>
            <div><div>Repeat Password:</div><div><input type=text id="password2" name= "password2" placeholder="This does nothing"></div></div>
            <div><button>Create Account</button></div>
        </div><!--create_account-->
        <div id="promo">
            <p>Post text that you would like to reviewed by our community of over 2 users!</p><br>
            <p>Give helpful feedback to friends.</p>
        </div><!--promo-->
    </div><!--login_grid-->
</body>
</html>