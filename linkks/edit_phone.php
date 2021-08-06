<?php

// Get the link data
$name = filter_input(INPUT_POST, 'name');
$link = filter_input(INPUT_POST, 'link');
$link_id = filter_input(INPUT_POST, 'linkId');

// Validate inputs
if ($link_id == null || $link_id == false || $name == null || $link == null) {
$error = "Invalid link data. Check all fields and try again.";
include('error.php');
} else {

// If valid, update the link in the database
require_once('database.php');

$query = 'UPDATE links SET
name = :name,
link = :link
WHERE linkId = :link_id';
$statement = $db->prepare($query);
$statement->bindValue(':name', $name);
$statement->bindValue(':link', $link);
$statement->bindValue(':link_id', $link_id);
$statement->execute();
$statement->closeCursor();

// Display the Product List page
include('index.php');
}
?>