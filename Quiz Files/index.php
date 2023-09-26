<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Compute the user's score and store it in the session
	$db = new PDO('mysql:host=localhost;dbname=quizDb;charset=utf8', 'root', '');
	$score = 0;

	foreach ($_POST['answer'] as $question_id => $answer_id) {
		$query = $db->prepare("SELECT is_correct FROM answers WHERE id = ?");
		$query->execute([$answer_id]);
		$is_correct = $query->fetchColumn();

		if ($is_correct) {
			$score++;
		}
	}

	$_SESSION['score'] = $score;

	// Redirect the user to a page that displays the score
	header('Location: score.php');
	exit;
}

// Display the quiz form
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quiz Generator</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Randomized Quiz Generator</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<?php
		// Connects to the database
		$db = new PDO('mysql:host=localhost;dbname=quizDb;charset=utf8', 'root', '');

		// Fetch the questions and answers from the database
		$query = $db->prepare("SELECT * FROM questions ORDER BY RAND() LIMIT 10");
		$query->execute();
		$questions = $query->fetchAll(PDO::FETCH_ASSOC);

		// Display the questions and answers
		foreach ($questions as $question) {
			echo '<h2>' . $question['question'] . '</h2>';

			// Fetch the answers for this question
			$query = $db->prepare("SELECT * FROM answers WHERE question_id = ?");
			$query->execute([$question['id']]);
			$answers = $query->fetchAll(PDO::FETCH_ASSOC);

			// Display the answers as radio buttons
			foreach ($answers as $answer) {
				echo '<label><input type="radio" name="answer[' . $question['id'] . ']" value="' . $answer['id'] . '"> ' . $answer['answer'] . '</label><br>';
			}
		}
		?>
		<input type="submit" value="Submit" class="btn">
        <p>This Quiz Is Randomised evertime you refresh<br>Courtesy of Group 3 BSE</p>
	</form>
</body>
</html>
