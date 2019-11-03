<?php
    session_start();

    if($_SESSION[user_id]) {
        header('Location: dashboard.php');
    }

    require "dbConnect.php";
    $db = get_db();

    $new_user = $pass1 = $pass2 = $new_display = "";
    $usernameErr = $pass1Err = $pass2Err = $display_nameErr = "";
    $good = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "* Username is required";
            $_SESSION[new_user] = "";
            $good = false;
        } else {
            //check that field wasn't empty
            $_SESSION[new_user] = test_input($_POST["username"]);
            $new_user = $_SESSION[new_user];
            //check that only letters, numbers, and whitespace are used
            if (!preg_match("/^[1-9a-zA-Z ]*$/",$new_user)) {
                $usernameErr = "* Only letters, numbers, and white space in username";
                $good = false;
            }
            //check to see if username is already in database
            else {
                $statement = $db->prepare("SELECT username FROM profile WHERE username = '$new_user'");
                $statement->execute();
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                if($row) {
                    $usernameErr = "* Username \"$new_user\" is already taken :(";
                    $good = false;
                }
            }
        }

        if (empty($_POST["display_name"])) {
            $display_nameErr = "* Display Name is required";
            $_SESSION[new_display] = "";
            $good=false;
        } else {
            $_SESSION[new_display] = test_input($_POST["display_name"]);
            $new_display = $_SESSION[new_display];
            if (!preg_match("/^[1-9a-zA-Z ]*$/",$new_display)) {
                $display_nameErr = "* Only letters, numbers, and white space in display name";
                $good = false;
            }
            //check to see if display name is already in database
            else {
                $statement = $db->prepare("SELECT display_name FROM profile WHERE display_name = '$new_display'");
                $statement->execute();
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                if($row) {
                    $display_nameErr = "Display name \"$new_display\" is already taken :(";
                    $good = false;
                }
            }
        }

        if (empty($_POST["password1"])) {
            $pass1Err = "* Password Required";
            $good=false;
        } else {
            $pass1 = test_input($_POST["password1"]);
            if (!preg_match("/^[1-9a-zA-Z]*$/",$pass1)) {
                $pass1Err = "* Only letters and numbers in password";
                $good = false;
            }
        }

        if (empty($_POST["password2"])) {
            $pass2Err = "* Reenter Password";
            $good = false;
        } else {
            $pass2 = test_input($_POST["password2"]);
            if ($pass1 != $pass2) {
                $pass2Err = "* Password was entered incorrectly";
            }
        }

        if ($good == true) {

            $hashed_pass = password_hash($pass1, PASSWORD_DEFAULT);
            $statement = $db->prepare("INSERT INTO profile(username, password, display_name) VALUES ('$new_user', '$hashed_pass', '$new_display')");
            $statement->execute();
            $_SESSION[user_id] = $db->lastInsertId('profile_user_id_seq');
            $_SESSION[username] = $new_user;
            header("Location: welcome.php");
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
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
            'header header'
            'form form'
            'promo promo';
    }
    #banner {
        grid-area: banner;
        background-color: snow;
        color: rgb(120, 0, 75);
        display: flex;
        flex-direction: column;
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
        margin: auto;
        padding: 0 30px;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        border: 2px dotted white;
        width: 50%;
    }
    #create_account div {
        margin: 5px;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-items: baseline;
        justify-content: space-between;
    }
    #promo {
        display: none;
        grid-area: promo;
        font-size: 20px;
        padding: 0 20%;
    }
    h1 {
        font-size: 3vw;
    }
    .error {
        color: lightpink;
        text-shadow: 0 0 20px rgb(50, 0, 30);
        margin-top: -10px;
    }
    @media screen and (min-width: 900px) {
        #login_grid {
            grid-template-areas:
            'banner banner'
            'header form'
            'promo form';
        }
        #promo {
            display: initial;
        }
        #banner {
            flex-direction: row;
        }
        #create_account {
            border: none;
            border-left: 2px dotted white;
        }
    }
    @media screen and (min-width: 620px) {
        #create_account div {
            flex-direction: row;
        }
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
                <label>Password: </label><input type=password name="password" <?php /*echo "\"" . $_SESSION[username] . "\"" */?> placeholder="Enter Password">
                <button type="submit">Login</button>
            </form>
        </div><!--banner-->
        <form id="create_account" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div>
                <label>Username:</label>
                <div><input type=text id="username" name="username" value="<?php echo $_SESSION[new_user];?>" placeholder="Enter Username"></div>
            </div>
            <div class="error"><?php echo $usernameErr?></div>
            <div>
                <label>Display Name:</label>
                <div><input type=text id="display_name" name="display_name" value="<?php echo $_SESSION[new_display];?>" placeholder="Enter Display Name"></div>
            </div>
            <div class="error"><?php echo $display_nameErr?></div>
            <div>
                <label>Password:</label>
                <div><input type=text id="password1" name="password1" placeholder="Enter Password"></div>
            </div>
            <div class="error"><?php echo $pass1Err?></div>
            <div>
                <label>Repeat Password:</label>
                <div><input type=text id="password2" name= "password2" placeholder="Reenter Password"></div>
            </div>
            <div class="error"><?php echo $pass2Err?></div>
            <button type="submit">Create Account</button>
        </form><!--create_account-->
        <div id="promo">
            <p>Post text that you would like to reviewed by our community of over 2 users!</p><br>
            <p>Give helpful feedback to friends.</p>
        </div><!--promo-->
    </div><!--login_grid-->
</body>
</html>