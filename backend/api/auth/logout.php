<?php
session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_destroy();
    echo json_encode(['message' => 'Déconnexion réussie']);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Non connecté']);
}
?>