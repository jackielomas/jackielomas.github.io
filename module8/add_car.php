<?php
/*****************************************************************************
Title: Home screen
Use: Module 10
Author:  Jackie Lomas
School:  Southern Illinois University Carbondale
Term: Fall 2020
Developed:  10/26/2020
Tested:  10/30/2020
******************************************************************************/


// Get the product data
$make = filter_input(INPUT_POST, 'make');
$model = filter_input(INPUT_POST, 'model');
$color = filter_input(INPUT_POST, 'color');
$year = filter_input(INPUT_POST, 'year');
$price = filter_input(INPUT_POST, 'price');

// Validate inputs
if ($make == null || $make == false ||
        $model == null || $color == null || $year == null || $price == null || $price == false) {
    $error = "Invalid data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('db_conn.php');

    // Add the product to the database  
    $query = 'INSERT INTO cars
                 (car_make, car_model, car_color, car_year, car_price)
              VALUES
                 (:make, :model, :color, :year, :price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':make', $make);
    $statement->bindValue(':model', $model);
    $statement->bindValue(':color', $color);
	$statement->bindValue(':year', $year);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}
?>