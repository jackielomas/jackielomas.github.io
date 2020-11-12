<?php
/*****************************************************************************
Title: Home screen
Use: Module 8
Author:  Jackie Lomas
School:  Southern Illinois University Carbondale
Term: Fall 2020
Developed:  10/9/2020
Tested:  10/11/2020
******************************************************************************/


require_once('db_conn.php');

// Get IDs
$car_id = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($car_id != false) {
    $query = 'DELETE FROM cars
              WHERE car_id = :car_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':car_id', $car_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}


// Display the Product List page
include('index.php');

?>

