<?php
session_start();
include 'config.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $user_name, $hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        // Set session variables for logged in user
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $user_name;
        $_SESSION['logged_in'] = true;

        // Redirect to home page
        header("Location: home.php");
        exit();
    } else {
        // Display error message for failed login
        echo "Invalid username or password";
    }

    $stmt->close();
}
?>
