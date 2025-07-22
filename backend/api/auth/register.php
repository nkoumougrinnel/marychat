<?php
require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../models/User.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

// Validation
if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Tous les champs sont obligatoires']);
    exit;
}

$userModel = new User();

if ($userModel->findByEmail($data['email'])) {
    http_response_code(409);
    echo json_encode(['error' => 'Email déjà utilisé']);
    exit;
}

if ($userModel->create($data['username'], $data['email'], $data['password'])) {
    http_response_code(201);
    echo json_encode(['message' => 'Compte créé avec succès']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la création du compte']);
}
?>