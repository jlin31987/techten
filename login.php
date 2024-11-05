<?php
session_start();
include 'config.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $user_name, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $user_name;
        $_SESSION['logged_in'] = true;

        header("Location: home.php");
        exit();
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}
?>
