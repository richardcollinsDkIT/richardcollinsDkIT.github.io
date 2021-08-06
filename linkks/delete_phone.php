<?php

session_start();

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    header('Location: login.php');
    exit;
}

require_once('database.php');

$link_id = filter_input(INPUT_POST, 'link_id');

if ($link_id != false) {
    $query = "DELETE FROM links
              WHERE linkId = :link_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':link_id', $link_id);
    $statement->execute();
    $statement->closeCursor();
}

include('index.php');
?>