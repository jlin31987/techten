<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: login.html");
    exit();
}

//Store logged in user's ID
$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Passwords</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div><a href="home.php" style="color: white; text-decoration: none;">Password Generator</a></div>
        <div class="login-link">
            <span id="userName"><?= htmlspecialchars($_SESSION['username']) ?></span>
            <a href="logout.php" style="color: white; text-decoration: none; margin-left: 20px;">Logout</a> 
        </div>
    </header>
    
    <div class="content-container">
        <nav class="navbar">
            <ul>
                <li class="underline">Saved Passwords</li>
                <li><a href="home.php" style="color: #001233; text-decoration: none;">Password Generator</a></li>
            </ul>
        </nav>

        <div class="password-table">
            <h2>Your Saved Passwords</h2>
            <table>
                <thead>
                    <tr>
                        <th>Website Name</th>
                        <th>Password</th>
                        <th><input type="checkbox" id="showPassword"> Show Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT website, password FROM saved_passwords WHERE user_id = ?");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['website']}</td>
                                    <td><input type='password' value='{$row['password']}' readonly></td>
                                    <td><button class='copy-btn'>📋</button></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No passwords saved yet.</td></tr>";
                    }

                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('showPassword').addEventListener('change', function () {
            const passwordFields = document.querySelectorAll('tbody input[type="password"]');
            passwordFields.forEach(field => {
                field.type = this.checked ? 'text' : 'password';
            });
        });

        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const passwordInput = this.closest('tr').querySelector('input');
                passwordInput.select();
                document.execCommand('copy');
                alert('Password copied to clipboard!');
            });
        });
    </script>
</body>
</html>
