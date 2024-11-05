<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_user = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $check_user->bind_param("ss", $username, $email);
    $check_user->execute();
    $result = $check_user->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Username or email already exists']);
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'User registered successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error registering user']);
        }

        $stmt->close();
    }

    $check_user->close();
    $conn->close();
}
?>
