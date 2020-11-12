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
        <h1>Add Product</h1>
        <form action="add_car.php" method="post"
              id="add_car_form">

            <label>Car Make:  </label>
            <input type="text" name="make"><br>

            <label>Car Model:  </label>
            <input type="text" name="model"><br>

            <label>Car Color:  </label>
            <input type="text" name="year"><br>
			
			<label>Car Year:  </label>
            <input type="text" name="color"><br>

            <label>Car Price:  </label>
            <input type="text" name="price"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Car"><br>
        </form>
        <p><a href="index.php">View Car List</a></p>
    </main>

    <footer>
        <p>Car Manager</p>
    </footer>
</body>
</html>