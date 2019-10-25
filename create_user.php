<?php

session_start();
require "dbConnect.php";
$db = get_db();

// define variables and set to empty values
$new_user = $pass1 = $pass2 = $new_display = "";
$usernameErr = $pass1Err = $pass2Err = $display_nameErr = "";
$good = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
        $_SESSION[new_user] = "";
        $good = false;
    } else {
        $_SESSION[new_user] = test_input($_POST["username"]);
        $new_user = $_SESSION[new_user];
        if (!preg_match("/^[1-9a-zA-Z ]*$/",$new_user)) {
            $usernameErr = "Only letters, numbers, and white space in username";
            $good = false;
          }
    }

    if (empty($_POST["display_name"])) {
        $display_nameErr = "Display Name is required";
        $_SESSION[new_display] = "";
        $good=false;
    } else {
        $_SESSION[new_display] = test_input($_POST["addr1"]);
        $new_display = $_SESSION[new_display];
        if (!preg_match("/^[1-9a-zA-Z ]*$/",$new_display)) {
            $display_nameErr = "Only letters, numbers, and white space in display name";
            $good = false;
          }
    }

    if (empty($_POST["pass1"])) {
        $pass1Err = "Password Required";
        $good=false;
      } else {
        $pass1 = test_input($_POST["pass1"]);
        if (!preg_match("/^[1-9a-zA-Z]*$/",$pass1)) {
            $pass1Err = "Only letters and numbers in password";
            $good = false;
          }
      }

    if (empty($_POST["pass2"])) {
        $pass2Err = "Reenter Password";
        $good = false;
    } else {
        $pass2 = test_input($_POST["pass2"]);
        if ($pass1 != $pass2) {
            $pass2Err = "Password was entered incorrectly";
        }
    }

    if ($good == true) {

        $statement = $db->prepare("INSERT INTO profile(username, password, display_name) VALUES ('$new_user', '$pass1', '$new_display')");
        $statement->execute();
        $_SESSION[id] = $db->lastInsertId('profile_id_seq');
        $_SESSION[username] = $new_user;
        $_SESSION[password] = $pass1;
        header("Location: dashboard.php");
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>