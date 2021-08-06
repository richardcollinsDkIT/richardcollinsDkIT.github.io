<!DOCTYPE>

<head>
    <link rel="icon" href="image_uploads/link.png" type="png" sizes="16x16">
</head>
<?php

require_once('database.php');

session_start();

/**
 * Check if the user is logged in.
 */

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    
    exit;
}


// Get user ID
if (!isset($user_id)) {
    $user_id = filter_input(
        INPUT_GET,
        'user_id',
        FILTER_VALIDATE_INT
    );
    if ($user_id == NULL || $user_id == FALSE) {
        $user_id = $_SESSION['user_id'];
    }
}

// Get name for current user
$queryuser = "SELECT * FROM user
WHERE userID = :user_id";
$statement1 = $db->prepare($queryuser);
$statement1->bindValue(':user_id', $user_id);
$statement1->execute();
$user = $statement1->fetch();
$statement1->closeCursor();
$user_name = $user['username'];

// Get all user
$queryAlluser = 'SELECT * FROM user
ORDER BY userID';
$statement2 = $db->prepare($queryAlluser);
$statement2->execute();
$user = $statement2->fetchAll();
$statement2->closeCursor();

// Get link for selected user
$querylinks = "SELECT * FROM links
WHERE userID = :user_id
ORDER BY linkID";
$statement3 = $db->prepare($querylinks);
$statement3->bindValue(':user_id', $user_id);
$statement3->execute();
$links = $statement3->fetchAll();
$statement3->closeCursor();
?>

<div class="container">
    <?php
    include('includes/header.php');
    include('includes/sidebar.php');
    ?>

    <section>
        <!-- display a table of links -->
        <h2><?php echo $user_name; ?></h2>
        <table class="container-lg" class=".table">
            <tr>
                <th>Links</th>
            </tr>

            <?php foreach ($links as $link) : ?>
                <?php $aLink = $link['link']; ?>
                <tr >
                    <td><a href="<?php echo $link['link'] ?>" target="_blank"><?php echo $link['name']; ?></a></td>

                    </form>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td>
                    <a id="add_website" href="add_phone_form.php">Add Website</a>
                </td>
                <tr>
                <td>
                <a id="add_website" href="manage_products.php">Manage Links</a>
                </td>
                </tr>
            
            </tr>
        </table>
    </section>
