<?php
function generatePassword($length, $uppercase, $lowercase, $numbers, $symbols) {
    $chars = '';
    if ($uppercase === 'true') $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($lowercase === 'true') $chars .= 'abcdefghijklmnopqrstuvwxyz';
    if ($numbers === 'true') $chars .= '0123456789';
    if ($symbols === 'true') $chars .= '!@#$%^&*()-_=+[]{}<>?';

    if (empty($chars)) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}<>?'; 
    }

    $password = '';
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
