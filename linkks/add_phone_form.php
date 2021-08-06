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
$query = 'SELECT *
          FROM user
          ORDER BY userId';
$statement = $db->prepare($query);
$statement->execute();
$user = $statement->fetchAll();
$statement->closeCursor();

?>
<!-- the head section -->
<div class="container">
    <?php
    include('includes/header.php');

    ?>
    <div class="content">
        <h2>Add New Phone</h2>
        <form action="add_phone.php" method="post" enctype="multipart/form-data" id="edit_record_form">
            <input type="text" name="userId" placeholder="User Id" value="<?php echo $_SESSION['user_id']; ?>" hidden>

            <label>Website Name:</label>
            <input type="text" name="name" placeholder="Website Name" value="" required>
            <br>
            <br>

            <label>Website Link:</label>
            <input type="text" name="link" placeholder="Website Link" value="" required>
            <br>
            <br>

            <input id="buy_button" type="submit" value="Save Changes">
            <br>
        </form>
    </div>