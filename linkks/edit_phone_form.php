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
        <h2>Edit link</h2>
        <form action="edit_phone.php" method="post" enctype="multipart/form-data" id="edit_record_form">
            <input type="text" name="linkId" placeholder="Link Id" value="<?php echo $links['linkId']; ?>" hidden>

            <label>Website Name:</label>
            <input type="text" name="name" placeholder="Website Name" value="<?php echo $links['name']; ?>" required>
            <br>
            <br>

            <label>Website Link:</label>
            <input type="text" name="link" placeholder="Website Link" value="<?php echo $links['link']; ?>" required>
            <br>
            <br>

            <input id="buy_button" type="submit" value="Save Changes">
            <br>
        </form>
    </div>
    