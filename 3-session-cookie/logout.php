<?php
    session_start();

    // supprimer toutes les variables de session
    session_destroy();

    // ou alors supprimer une seule variable de session
    // unset($_SESSION['user']);

    // rediriger vers la page d'accueil
    header('Location: 4-exo.php');
?>