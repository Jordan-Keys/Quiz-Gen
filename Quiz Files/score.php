<?php
// Start session
session_start();

// Check if user has submitted the quiz form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize score to 0
    $score = 0;

    // Connect to the database
    $db = new PDO('mysql:host=localhost;dbname=quizDb;charset=utf8', 'root', '');

    // Fetch the correct answers from the database
    $query = $db->prepare("SELECT * FROM answers WHERE is_correct = 1");
    $query->execute();
    $correct_answers = $query->fetchAll(PDO::FETCH_ASSOC);

    // Check the user's answers against the correct answers
    foreach ($correct_answers as $answer) {
        $question_id = $answer['question_id'];
        $answer_id = $answer['id'];
        if ($_POST['answer'][$question_id] == $answer_id) {
            $score++;
        }
    }

    // Store the score in session
    $_SESSION['score'] = $score;
}

// End session
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Score</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php if (isset($_SESSION['score'])): ?>
        <h1>Your score is <?php echo $_SESSION['score']; ?></h1>
        <button onclick="goToQuizPage()">Go back to quiz page</button>
    <?php else: ?>
        <h1>No score to display</h1>
    <?php endif; ?>

    <script>
        function goToQuizPage() {
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>
