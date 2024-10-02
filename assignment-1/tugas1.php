<?php
// Define the grading scale
$gradingScale = array(
    'A' => 90,
    'B+' => 85,
    'B' => 80,
    'C+' => 75,
    'C' => 70,
    'D' => 60,
    'E' => 0
);

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $score = $_POST['score'];

    // Validate the input
    if (empty($name) || empty($nim) || !is_numeric($score) || $score < 0 || $score > 100) {
        $error = 'Invalid input. Please try again.';
    } else {
        // Determine the grade based on the score
        foreach ($gradingScale as $grade => $minScore) {
            if ($score >= $minScore) {
                $gradeReceived = $grade;
                break;
            }
        }

        // Display the result
        $result = "Hello, $name (NIM: $nim)! Your score is $score, which corresponds to a grade of $gradeReceived.";
    }
}

// Display the form
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>
    <label for="nim">NIM:</label>
    <input type="text" id="nim" name="nim"><br><br>
    <label for="score">Score (0-100):</label>
    <input type="number" id="score" name="score"><br><br>
    <input type="submit" value="Submit">
</form>

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php elseif (isset($result)): ?>
    <p><?php echo $result; ?></p>
<?php endif; ?>