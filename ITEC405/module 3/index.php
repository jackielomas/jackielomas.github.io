<!DOCTYPE html>
<?php
/*****************************************************************************
Title:  Module 3 - PHP Test Index Page
Use:  Use PHP to create form
Author:  Jackie Lomas
School:  Southern Illinois University Carbondale
Term: Fall 2020
Developed:  9/4/2020
Tested:  9/4/2020
******************************************************************************/
?>

<html>
<head>
    <title>PHP Test</title>
    <link rel="stylesheet" type="text/css" href="main2.css"/>
</head>

<body>
    <main>
    <h1>PHP Test</h1>
    <form action="response.php" method="post">

    <fieldset>
    <legend>Personal Information</legend>
        <label>Name:</label>
        <input type="text" name="user_name" value="" class="textbox">
        <br>

        <label>Secret Code:</label>
        <input type="password" name="secret_code" value="" class="textbox">
        <br>

        <input type="hidden" name="LabName" value="Week 3 Lab Exercise">
    </fieldset>

    <fieldset>
    <legend>Questions:</legend>

        <p><b>Question 1:</b>Which of the following is NOT visible on a page?</p>
        <input type="radio" name="question_one" value="Text Box">
        a. Text Box<br>
        <input type="radio" name="question_one" value="Password Box">
        b. Password Box<br>
        <input type=radio name="question_one" value="Hidden Field">
        c. Hidden Field<br>
		<input type=radio name="question_one" value="Check Box">
        d. Check Box<br><br>

        <p><b>Question 2:</b> Which of the following are iteration structures? [Choose all that apply]</p>
        <input type="checkbox" name="two[]" value="switch">a. Switch<br>
		<input type="checkbox" name="two[]" value="while_loop">b. While Loop<br>
		<input type="checkbox" name="two[]" value="do_while">c. Do-While Loop<br>
		<input type="checkbox" name="two[]" value="if">d. If<br>
		<input type="checkbox" name="two[]" value="for">e. For Loop<br><br>

        <p><b>Question 3:</b> You are strictly limited to one nesting of an "if" statement.</p>
        <select name="question_three">
                <option value="true">True</option>
                <option value="false">False</option>
        </select><br><br>

		<p><b>Question 4:</b> Which of the following do you use to display data on a webpage? [Choose all that apply]</p>
        <input type="checkbox" name="question_four" value="text_box">a. Text Box<br>
		<input type="checkbox" name="question_four" value="echo_statement">b. Echo Statememt<br>
		<input type="checkbox" name="question_four" value="text_area">c. Text Area<br>
		<input type="checkbox" name="question_four" value="print_statement">d. Print Statement<br>
    </fieldset>

    <input type="submit" value="Submit">
    <br>

    </form>    
    </main>
</body>
</html>