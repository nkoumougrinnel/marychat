<?php
session_start();
require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../models/User.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$userModel = new User();
$user = $userModel->verifyCredentials($data['email'], $data['password']);

if ($user) {
    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email']
    ];
    echo json_encode(['message' => 'Connexion réussie', 'user' => $_SESSION['user']]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Identifiants invalides']);
}
?>