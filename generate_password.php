<?php
// Function to generate password based on user preferences
function generatePassword($length, $uppercase, $lowercase, $numbers, $symbols) {
    // Initialize allowed characters
    $chars = '';
    
    // Add selected character types 
    if ($uppercase === 'true') $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($lowercase === 'true') $chars .= 'abcdefghijklmnopqrstuvwxyz';
    if ($numbers === 'true') $chars .= '0123456789';
    if ($symbols === 'true') $chars .= '!@#$%^&*()-_=+[]{}<>?';

    // Default to all characters if no type is selected
    if (empty($chars)) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}<>?'; 
    }

    $password = '';

    // Generate random password of specified length
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, strlen($chars) - 1)];
    }

    return $password;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $length = isset($_GET['length']) ? (int)$_GET['length'] : 12;
    $uppercase = $_GET['uppercase'] ?? 'false';
    $lowercase = $_GET['lowercase'] ?? 'false';
    $numbers = $_GET['numbers'] ?? 'false';
    $symbols = $_GET['symbols'] ?? 'false';

    $generatedPassword = generatePassword($length, $uppercase, $lowercase, $numbers, $symbols);

    echo json_encode(['password' => $generatedPassword]);
}
?>
