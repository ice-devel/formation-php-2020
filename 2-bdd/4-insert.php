<?php
    /**
    * INSERT EXO
    */

    /*
    *
    * Récap
    * Soumission d'un formulaire:
    * 1 - formulaire soumis ?
    * 2 - récupération des valeurs
    * 3 - vérification des valeurs
    * 4 - si pas d'erreurs, requête et/ou traitement avec ces valeurs
    *
    * Requete SQL
    * 1 - connexion serveur / choix base
    * 2 - requete sql
    * 3 - préparation
    * 4 - exécution
    * 5 - affichage ou/et traitement
    *
    */

    // 1 - formulaire soumis ?
    if (isset($_POST['btn-add-weapon'])) {
        // 2 - récupération
        $name = filter_input(INPUT_POST, 'name');
        $strength = filter_input(INPUT_POST, 'strength');
        $hasArea = filter_input(INPUT_POST, 'has_area');

        // 3 - vérifications
        $errors = [];

        if ($name == "" || strlen($name) > 30) {
            $errors['name'] = "Le nom est obligatoire et doit faire max 30 carac.";
        }

        if ($strength == "" || $strength < 0 || $strength > 100 || !preg_match("/\d+/", $strength)) {
            $errors['strength'] = "Force obligatoire, entier compris entre 0 et 100";
        }

        // aucune condition à réaliser pour la case à cocher "has_area"

        // 4 - si pas d'erreur, requete
        if (empty($errors)) {
            // 5 - enregistrement en bdd
            // 1 - connexion bdd
            $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
            // 2 - requete sql
            $query = "INSERT INTO weapon (name, strength, has_area)
                      VALUES (:name, :strength, :hasArea)";
            // 3 - preparation
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute([
                ':name' => $name,
                ':strength' => $strength,
                ':hasArea' => $hasArea == null ? 0 : 1,
            ]);
        }
    }
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>

    <h2>Création d'une arme</h2>

    <?php
        if (isset($errors) && !empty($errors)) {
            foreach ($errors as $error) {
                echo $error."<br>";
            }
        }

        if (isset($result)) {
            if ($result == true) {
                echo "Arme bien enregistrée.";
            }
            else {
                echo "Désolé une erreur serveur est survenue.";
            }
        }
    ?>
    <form method="post">
        <input type="text" name="name" placeholder="Nom de l'arme" />
        <input type="number" name="strength" placeholder="Puissance de l'arme (entre 0 et 100)"/>
        <input type="checkbox" name="has_area"/> Dégâts de zone
        <input type="submit" value="Enregistrer" name="btn-add-weapon"/>
    </form>

    </body>
    </html>