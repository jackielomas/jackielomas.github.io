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
    <title>Car Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Car Manager</h1></header>
<main>
	<br>
    <section>
        <!-- display a table of products -->
        <table>
            <tr>
                <th>Make</th>
				<th>Model</th>
				<th>Color</th>
				<th>Year</th>
                <th class="right">Price</th>
                <th>Delete?</th>
				<th>Edit</th>
            </tr>

            <?php foreach ($cars as $car) : ?>
            <tr>
                <td><?php echo $car['car_make']; ?></td>
                <td><?php echo $car['car_model']; ?></td>
				<td><?php echo $car['car_color']; ?></td>
				<td><?php echo $car['car_year']; ?></td>
                <td class="right"><?php echo $car['car_price']; ?></td>
                <td><form action="delete_car.php" method="post">
                    <input type="hidden" name="car_id"
                           value="<?php echo $car['car_id']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
				<td><form action="edit_car_form.php" method="post">
                    <input type="hidden" name="car_id"
                           value="<?php echo $car['car_id']; ?>">
                    <input type="submit" value="Edit">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_car_form.php">Add Car</a></p>    
    </section>
</main>
<footer>
    <p>Car Manager</p>
</footer>
</body>
</html>