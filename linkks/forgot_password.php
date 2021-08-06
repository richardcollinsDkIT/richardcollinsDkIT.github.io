<head>
    <link rel="icon" href="image_uploads/link.png" type="png" sizes="16x16">
</head>
<?php

/**
 * Start the session.
 */
session_start();

/**
 * Check if the user is logged in.
 */
if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}

require('database.php');

$queryuser = "SELECT * FROM user
WHERE userID = :user_id";
$statement1 = $db->prepare($queryuser);
$statement1->bindValue(':user_id', $user_id);
$statement1->execute();
$user = $statement1->fetch();
$statement1->closeCursor();
$user_name = $user['username'];

$link_id = filter_input(INPUT_POST, 'link_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM links
          WHERE linkID = :link_id';
$statement = $db->prepare($query);
$statement->bindValue(':link_id', $link_id);
$statement->execute();
$links = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!-- the head section -->
<div class="container">
    <?php
    include('includes/header.php');

    ?>
    
    <div class="content">
        <h2>Change Password</h2>
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php $user_name ?>" required><br><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password" required><br><br>
            <input type="submit" id="buy_button" name="login" value="Confirm">
        </form>
    </div>
    