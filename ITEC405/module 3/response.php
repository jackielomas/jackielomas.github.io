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
	
    // get the data from the form
    $user_name = filter_input(INPUT_POST, 'user_name');
    $secret_code = filter_input(INPUT_POST, 'secret_code');
	$LabName = filter_input(INPUT_POST, 'LabName');

    //question one (radio button)
    $question_one = filter_input(INPUT_POST, 'question_one');
    if ($question_one === "Hidden Field") {
        $question_one = "Correct";
    }
	else {
		$question_one = "Incorrect. The correct answer is Hidden Field";
	}
    
	//question two (checkbox) - use while loop
	/****$switch = isset($_POST['switch']);
	$while_loop = isset($_POST['while_loop']);
	$do_while = isset($_POST['do_while']);
	$if = isset($_POST['if']);*/

	
	$question_two = filter_input(INPUT_POST, 'two', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
	if ($question_two !== NULL) {
		$two1 = $question_two [0];
		$two2 = $question_two [1];
		$two3 = $question_two [2];
	}
	
	if ($question_two !== NULL) {
			foreach($question_two as $key => $value) {
				echo $key. ' = ' . $value . '<br>';
			}
	} 
	//no answers selected - incorrected
	else {
		$question_two = "Incorrect. The correct answer is all";
	}
	

	//question 3 (drop down box)
    $question_three = filter_input(INPUT_POST, 'question_three');
	if ($question_three === "false"){
		$question_three = "Correct";
	}
	else {
		$question_three = "Incorrect. The correct answer is False.";
	}
	
	//question four (checkbox) - use for loop
    $question_four = $_POST['question_four'];
	$question_four = 'echo_statement' && 'print_statement';
    for ($i = 1; $i < 4; $i++){
		if ($question_four === 'echo_statement' && 'print_statement'){
				$question_four = 'Correct.';
		}
		else {
        $question_four = 'Incorrect. The correct answer is Echo and Print Statement';
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo ($LabName); ?></title>
    <link rel="stylesheet" type="text/css" href="main2.css"/>
</head>
<body>
    <main>
        <h1>Test Grade</h1>

        <label><?php echo $user_name; ?> - </label>
        <span>Your secret code is <?php echo htmlspecialchars ($secret_code); ?></span><br>

        <label>Question 1:</label>
        <span><?php echo htmlspecialchars($question_one); ?></span><br>

        <label>Question 2:</label>
        <span><?php echo htmlspecialchars($question_two); ?></span><br>

        <label>Question 3:</label>
        <span><?php echo htmlspecialchars($question_three); ?></span><br>

        <label>Question 4:</label>
        <span><?php echo htmlspecialchars($question_four); ?></span><br><br>

    </main>
</body>
</html>