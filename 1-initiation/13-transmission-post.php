<?php
    // envoyer des données depuis le navigateur vers le serveur
    // grâce à la méthode POST : passer des params en arrière-plan

    /**
     * Quand est-ce qu'il faut choisir GET ou POST ?
     *
     * Avantages:
     *  - GET :
     *      - partage d'url, retrouver l'historique, mettre en favoris des pages avec des informations déjà présentes
     *      ( comme le numéro de page d'un blog)
     *      - on va pouvoir créer des liens pour pointer des pages avec des paramètres spécifiques
     *      déjà définis
     *  - POST :
     *      - on ne voit les paramètres envoyés si on est derrière l'écran, ni dans l'historique
     *      - pas de limite de caractère
     * Inconvénients:
     * - GET :
     *      - les paramètres sont dans l'URL donc on peut par exemple voir un mot de passe dans l'url ou dans l'historique
     *      - limit de caractères
     * - POST :
     *      - on ne peut pas partager des urls avec des paramètres prédéfinis
     *
     * WARNING:
     *  - en terme de sécurité, techniquement parlant, l'un ou l'autre c'est strrev("LIERAP")
     * C'EST PAREIL : c'est à dire c'est pas sécurisé du tout, la sécurité, c'est côté serveur
     */

    // les données envoyées en POST sont automatiquement insérées dans la variable globale $_POST
    if (isset($_POST['form'])) {
        // récupération
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        $city = $_POST['city'];

        // éviter que les clés n'existent (pirate, etc.)

        // V1
        $name = "";
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }

        // V2 : ternaire
        $name = isset($_POST['name']) ? $_POST['name'] : null;

        // V3 : utiliser une fonction toute faite : FAUT FAIRE CA SI FROM SCRATCH
        $name = filter_input(INPUT_POST, 'name');

        // si c'est dans le tableau GET :
        // $name = filter_input(INPUT_GET, 'name');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transmission</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="name"/>
        <input type="password" name="pass"/>
        <input type="text" name="city" />
        <input type="submit" name="form" />
    </form>
</body>
</html>
