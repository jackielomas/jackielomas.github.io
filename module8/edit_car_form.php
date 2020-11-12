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


require('db_conn.php');

// Get IDs
$car_id = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
$queryCars = 'SELECT * FROM cars
                  ORDER BY car_make';
$statement3 = $db->prepare($queryCars);
//$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$cars = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Car Manager</h1></header>

    <main>
        <h1>Update Product</h1>
        <form action="edit_car.php" method="post"
              id="edit_car_form">
			  
			<?php foreach ($cars as $car) : ?>  

            <label>Car Make:  </label>
            <input type="text" name="make" value="<?php echo $car['car_make']; ?>"><br>

            <label>Car Model:  </label>
            <input type="text" name="model" value="<?php echo $car['car_model']; ?>"><br>

            <label>Car Color:  </label>
            <input type="text" name="year" value="<?php echo $car['car_color']; ?>"><br>
			
			<label>Car Year:  </label>
            <input type="text" name="year" value="<?php echo $car['car_year']; ?>"><br>

            <label>Car Price:  </label>
            <input type="text" name="price" value="<?php echo $car['car_price']; ?>"><br>
			
            <label>&nbsp;</label>
            <input type="submit" value="Update Car"><br>
        </form>
		<?php endforeach; ?>
        <p><a href="index.php">View Car List</a></p>
    </main>

    <footer>
        <p>Car Manager</p>
    </footer>
</body>
</html>