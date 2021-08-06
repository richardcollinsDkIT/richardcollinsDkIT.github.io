<head>
    <link rel="icon" href="image_uploads/link.png" type="png" sizes="16x16">
</head>
<?php

//register.php

/**
 * Start the session.
 */
session_start();

/**
 * Include ircmaxell's password_compat library.
 */
require 'libary-folder/password.php';

/**
 * Include our MySQL connection.
 */
require 'login_connect.php';
?>
<div class="container">
    <?php
    include('includes/header.php');
    ?>
    <?php


    //If the POST var "register" exists (our submit button), then we can
    //assume that the user has submitted the registration form.
    if (isset($_POST['register'])) {

        //Retrieve the field values from our registration form.
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;

        //TO ADD: Error checking (username characters, password length, etc).
        //Basically, you will need to add your own error checking BEFORE
        //the prepared statement is built and executed.

        //Now, we need to check if the supplied username already exists.

        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(username) AS num FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        //Bind the provided username to our prepared statement.
        $stmt->bindValue(':username', $username);

        //Execute.
        $stmt->execute();

        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //If the provided username already exists - display error.
        //TO ADD - Your own method of handling this error. For example purposes,
        //I'm just going to kill the script completely, as error handling is outside
        //the scope of this tutorial.
        if ($row['num'] > 0) {
            die('That username already exists!');
        }

        //Hash the password as we do NOT want to store our passwords in plain text.
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

        //Prepare our INSERT statement.
        //Remember: We are inserting a new row into our users table.
        $sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);

        //Bind our variables.
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $passwordHash);

        //Execute the statement and insert the new account.
        $result = $stmt->execute();

        //If the signup process is successful.
        if ($result) {
            //What you do here is up to you!
            echo "<script> window.alert('Register Successful!');</script>";

            header('Location: login.php');
        }
    }
    ?>
    <div class="content">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required pattern="^(?=.{4,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$" title="Username must be less than 15 characters"><br><br>

            <label for='email'>Email:</label>
            <input id="username" type="email" name="email" required /> <br><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><br><br>
            <input type="submit" id="buy_button" name="register" value="Confirm"></button>
        </form>
    </div>
