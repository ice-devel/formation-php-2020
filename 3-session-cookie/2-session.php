<?php
    /*
     * Les sessions sont un moyen de transmettre des informations de page en page
     * Elles sont stockées sur le serveur
     */
    // cette fonction doit être obligatoirement avant le moindre affichage
    // elle démarre les sessions
    // Comparé au GET et POST, il y a une couche de persistance
    // même si la durée de vie est limitée (à la fermeture du navigateur)
    session_start();

    // suppression de la session
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION);
    }

    if (isset($_POST['name'])) {
        $name = filter_input(INPUT_POST, 'name');

        // stocker une valeur en session, la clé 'username' est le choix du developpeur
        $_SESSION['username'] = $name;
    }
?>

<?php
    if (isset($_SESSION['username'])) {
        echo "Bonjour ".$_SESSION['username'];
        echo " <a href='?logout'>Déconnexion</a>";
    }
?>
<form method="post">
    <input type="text" name="name" />
    <input type="submit" />
</form>


