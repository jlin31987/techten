<?php
session_start();
include 'config.php'; 

$loggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';  

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_password']) && $loggedIn) {
    $website = $_POST['website'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO saved_passwords (user_id, website, password) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $website, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Password saved successfully!');</script>";
    } else {
        echo "<script>alert('Failed to save password.');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        Password Generator
    </header>

    <div class="content-container">
        <div class="password-generator">
            <input type="text" id="generatedPassword" placeholder="Generated Password">
            <button id="generateBtn">Generate</button>
        </div>
    </div>
</body>
</html>
