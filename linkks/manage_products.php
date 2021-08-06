<head>
    <link rel="icon" href="image_uploads/link.png" type="png" sizes="16x16">
</head>
<!DOCTYPE>

<head>
    <link rel="icon" href="image_uploads/favicon.png" type="png" sizes="16x16">
</head>
<?php

require_once('database.php');

session_start();

if (!$_SESSION['user_id'] == 1 || !isset($_SESSION['logged_in']) ) {
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
?>
<aside>
        <!-- display a list of user -->
        <BR>
        <BR>
        <h2>USERS</h2>
        <nav>
            <ul>
                <?php foreach ($user as $user) : ?>
                    <li><a href=".?user_id=<?php echo $user['userId']; ?>">
                            <?php echo $user['username']; ?>
                        </a><br>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </aside>
    <section>
        <!-- display a table of links -->
        <h2><?php echo $user_name; ?></h2>
        <table>
            <tr>
                <th>Links</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($links as $link) : ?>
                <?php $aLink = $link['link']; ?>
                <tr>
                    <td><a href="<?php echo $link['link'] ?>" target="_blank"><?php echo $link['name']; ?></a></td>
                    <td>
                        <form action="edit_phone_form.php" method="post" id="edit_phone_form">
                            <input type="hidden" name="link_id" value="<?php echo $link['linkId']; ?>">
                            <input id="edit_button" type="submit" value="Edit">
                        </form>
                        <form action="delete_phone.php" method="post" id="delete_phone_form">
                            <input type="hidden" name="link_id" value="<?php echo $link['linkId']; ?>">
                            <input id="delete_button" type="submit" value="Delete">
                        </form>
                    </td>

                    </form>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
