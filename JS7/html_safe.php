<?php
// Inisialisasi variabel
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = isset($_POST['input']) ? $_POST['input'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Sanitasi input
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    // Validasi email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $userInput = isset($_POST['userInput']) ? htmlspecialchars($_POST['userInput'], ENT_QUOTES, 'UTF-8') : '';

        echo "<div>$userInput</div>";
    } else {
        echo "<div>Invalid email address.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Safe Input</title>
</head>
<body>
    <form method="POST" action="">
        <label for="input">Input:</label>
        <input type="text" id="input" name="input" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="userInput">User Input:</label>
        <input type="text" id="userInput" name="userInput">

        <input type="submit" value="Submit">
    </form>
</body>
</html>