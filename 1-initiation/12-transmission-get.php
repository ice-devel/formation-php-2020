<?php
    // envoyer des données depuis le navigateur vers le serveur
    // grâce à la méthode GET : passer des params dans l'URL

    // GET est une variable globale PHP automatique initialisée avec
    // les paramètres d'URL : ce qui se trouve après le "?" dans une url

    $nom = "";
    // warning : le paramètre GET 'nom' pouvant ne pouvant ne pas exister,
    // il faut penser à le vérifier avant de l'utiliser
    if (isset($_GET['nom'])) {
        $nom = $_GET['nom'];
    }

?>

Coucou <?php echo $nom; ?>
