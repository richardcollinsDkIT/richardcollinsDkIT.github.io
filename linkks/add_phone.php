<?php

// PUT the product data
$name = filter_input(INPUT_POST, 'name');
$user_id = filter_input(INPUT_POST, 'userId');
$link = filter_input(INPUT_POST, 'link');


// Validate inputs
if ($user_id == null || $user_id == false || $name == null || $link == null) {
    $error = "Invalid form data";
    include('error.php');
    exit();
} else {

    require_once('database.php');

    // Add the product to the database 
    $query = "INSERT INTO links
                 (name, userId,  link)
              VALUES
                 (:name, :user_id, :link)";
    $statement = $db->prepare($query);

    $statement->bindValue(':name', $name);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':link', $link);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}