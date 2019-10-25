<?php
    session_start();

    if($_SESSION[user_id]) {
        header('Location: dashboard.php');
    }

    require "dbConnect.php";
    $db = get_db();

    include("create_user.php");
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
            padding: 10% 20%;
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
            padding: 10% 20%;
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
            <form action="process_login.php" method="post">
                <label>Username: </label><input type=text name="username" <?php /*echo "\"" . $_SESSION[username] . "\"" */?> placeholder="Enter Username">
                <label>Password: </label><input type=text name="password" <?php /*echo "\"" . $_SESSION[username] . "\"" */?> placeholder="Enter Password">
                <button type="submit">Login</button>
            </form>
        </div><!--banner-->
        <form id="create_account" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div>
                <label>Username:</label>
                <div><input type=text id="username" name="username" value="<?php echo $_SESSION[new_user];?>" placeholder="Enter Username"></div>
            </div>
            <div>
                <label>Display Name:</label>
                <div><input type=text id="display_name" name="display_name" value="<?php echo $_SESSION[new_display];?>" placeholder="Enter Display Name"></div>
            </div>
            <div>
                <label>Password:</label>
                <div><input type=text id="password" name="password" value="<?php echo $_SESSION[pass1];?>" placeholder="Enter Password"></div>
            </div>
            <div>
                <label>Repeat Password:</label>
                <div><input type=text id="password2" name= "password2" value="<?php echo $_SESSION[pass2];?>" placeholder="Reenter Password"></div>
            </div>
            <div><button type="submit">Create Account</button></div>
        </form><!--create_account-->
        <div id="promo">
            <p>Post text that you would like to reviewed by our community of over 2 users!</p><br>
            <p>Give helpful feedback to friends.</p>
        </div><!--promo-->
    </div><!--login_grid-->
</body>
</html>