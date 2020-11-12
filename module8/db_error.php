<?php/*****************************************************************************
Title: Home screen
Use: Module 8
Author:  Jackie Lomas
School:  Southern Illinois University Carbondale
Term: Fall 2020
Developed:  10/9/2020
Tested:  10/11/2020
******************************************************************************/
</?>


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
        <h1>Database Error</h1>
        <p>MySQL must be running.</p>
        <p>Error message: <?php echo $error_message; ?></p>
        <p>&nbsp;</p>
    </main>

    <footer>
        <p>Car Manager</p>
    </footer>
</body>
</html>