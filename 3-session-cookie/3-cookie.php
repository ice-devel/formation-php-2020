<?php
    /*
     * Les cookies sont un moyen de transmettre des informations de page en page
     * Ils sont stockés sur le client
     * Comparé au GET et POST, il y a une couche de persistance (durée de vie limitée quand même)
     */

    if (isset($_GET['logout'])) {
        // supprimer la variable PHP pour que le reste du script ne puisse l'utiliser
        //unset($_COOKIE['username']);
        // côté navigateur, il faut en fait envoyer un cookie qui le même nom
        // pour écraser
        setcookie('username', null);
        // rediriger vers une même page pour prendre en compte de suite la suppression du cookie
        header('Location: 3-cookie.php');
        exit;
    }

    if (isset($_POST['name'])) {
        $name = filter_input(INPUT_POST, 'name');

        // stocker une valeur en session, la clé 'username' est le choix du developpeur
        // pour un mois
       setcookie("username", $name, time() + 3600);
       // rediriger vers une page pour prendre en compte de suite le cookie
       header('Location: 3-cookie.php');
       exit;
    }
?>

<?php
    if (isset($_COOKIE['username'])) {
        echo "Bonjour ".$_COOKIE['username'];
        echo " <a href='?logout'>Déconnexion</a>";
    }
?>

<form method="post">
    <input type="text" name="name" />
    <input type="submit" />
</form>


