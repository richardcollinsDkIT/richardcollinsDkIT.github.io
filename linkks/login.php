<head>
    <link rel="icon" href="image_uploads/link.png" type="png" sizes="16x16">
</head>
<?php

//login.php

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


//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if (isset($_POST['login'])) {

    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    //Retrieve the user account information for the given username.
    $sql = "SELECT userId, username, password FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    //Bind value.
    $stmt->bindValue(':username', $username);

    //Execute.
    $stmt->execute();

    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //If $row is FALSE.
    if ($user === false) {
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        echo'<script>window.alert("Incorrect Login Details! No User with That Name</script>';
    } else {
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.

        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);

        //If $validPassword is TRUE, the login has been successful.
        if ($validPassword) {

            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['userId'];
            $_SESSION['name'] = $user['username'];
            $_SESSION['logged_in'] = time();

            echo '<pre>';
            var_dump($_SESSION);
            echo '</pre>';

            //Redirect to our protected page, which we called home.php
            header('Location: index.php');
            exit;
        } else {
            //$validPassword was FALSE. Passwords do not match.
            echo'<script>alert("Incorrect Login Details! Wrong Passsword</script>';
        }
    }
}

?>

<div class="container">
    <?php
    include('includes/header.php');

    ?>
    <div class="content">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" id="buy_button" name="login" value="Confirm">
        </form>
    </div>