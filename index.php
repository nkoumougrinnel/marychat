<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    // Rediriger vers la page d'accueil ou de messagerie
    header("Location: frontend/pages/chat.html");
    exit();
} else {
    // Rediriger vers la page de connexion
    header("Location: frontend/pages/login.html");
    exit();
}
?>
