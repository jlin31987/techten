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
        <div class="login-link">
            <?php if ($loggedIn): ?>
                <span id="userName"><?= htmlspecialchars($userName) ?></span> 
                <a href="logout.php" id="logoutLink" style="margin-left: 20px;">Logout</a> 
            <?php else: ?>
                <a href="login.html" id="loginLink">Sign In</a> 
            <?php endif; ?>
        </div>
    </header>

    <nav class="navbar">
            <ul>
                <li><a href="saved_password.php" style="color: #001233; text-decoration: none;">Saved Passwords</a></li>
                <li class="underline">Password Generator</li>
            </ul>
        </nav>
    
    <div class="content-container">
        <div class="password-generator">
            <div class="input-container">
                <input type="text" id="generatedPassword" placeholder="Enter or generate password" class="styled-input">  
                <button id="copyBtn">Copy</button>  
            </div>
            
            <div class=options-container>
                <div class="slider-container">
                    <input type="range" id="passwordLength" min="6" max="32" value="12">
                    <span id="lengthDisplay">Length: 12</span>
                </div>
            
                <div class="checkboxes">
                    <label><input type="checkbox" id="includeUppercase"> Uppercase</label>
                    <label><input type="checkbox" id="includeLowercase"> Lowercase</label>
                    <label><input type="checkbox" id="includeNumbers"> Number</label>
                    <label><input type="checkbox" id="includeSymbols"> Symbol</label>
                </div>
            </div>

        
            <div class="buttons">
                <button id="generateBtn" class="styled-button">Generate</button>
            </div>

            <?php if ($loggedIn): ?>
    <div id="saveForm" class="rounded-box">
        <form method="post" action="home.php">
            <div class="input-container">
                <input type="text" id="website" name="website" placeholder="Enter website name" required class="styled-input">
                <input type="hidden" id="password" name="password">
                <button type="submit" name="save_password" class="styled-button save-password-btn">Save Password</button>

            </div>
        </form>
    </div>
<?php endif; ?>
        </div>
    </div>
