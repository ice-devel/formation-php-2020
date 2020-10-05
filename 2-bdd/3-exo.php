<?php
    /**
     * SELECT EXO
     */

     /*
      *
      * Récap
      * Requete SQL
      * 1 - connexion serveur / choix base
      * 2 - requete sql
      * 3 - préparation
      * 4 - exécution
      * 5 - affichage ou/et traitement
      *
      * Soumission d'un formulaire:
      * 1 - formulaire soumis ?
      * 2 - récupération des valeurs
      * 3 - vérification des valeurs
      * 4 - si pas d'erreurs, requête et/ou traitement avec ces valeurs
      */

/**
 * Exercice :
 * 1- Créer un formulaire avec deux champs : 1 pour le nom et un pour le zipcode
 * 2- lorsque le form est soumis, la page doit afficher les utilisateurs correspondant
 * au zipcode choisi et au nom choisi :
 * SELECT * FROM player
 * SELECT * FROM player WHERE name
 * SELECT * FROM player WHERE zipcode
 * SELECT * FROM player WHERE name AND zipcode
 * Exemples :
 * l'utilisateur saisit toto et 59000, il faut donc afficher tous les joueurs
 * qui s'appellent toto et qui habitent à Lille
 * l'utilisateur saisit david, il faut afficher tous les joueurs qui s'appellent david
 */
    // 1 - formulaire soumis ?
    if (isset($_GET['btn-filter'])) {
        // 2 - récupération des valeurs
        $name = filter_input(INPUT_GET, 'name');
        $zipcode = filter_input(INPUT_GET, 'zipcode');

        // 3 - quelle requête ? ça dépend des filtres
        if ($name != "" && $zipcode != "") {
            $sql = "SELECT * FROM player WHERE name = :paramName AND zipcode = :paramZp";
            $paramsPDO = [':paramName' => $name, ':paramZp' => $zipcode];
        }
        elseif ($zipcode != "") {
            $sql = "SELECT * FROM player WHERE zipcode = :paramZp";
            $paramsPDO = [':paramZp' => $zipcode];
        }
        elseif ($name != "") {
            $sql = "SELECT * FROM player WHERE name = :paramName";
            $paramsPDO = [':paramName' => $name];
        }
        else {
            $sql = "SELECT * FROM player";
            $paramsPDO = null;
        }

        // 4 - execution de la requete
        $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
        $stmt = $pdo->prepare($sql);
        $stmt->execute($paramsPDO);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

    // autre possibilité : imaginons un seul champ de recherche, qui recherche dans tous les champs de la bdd
    if (isset($_GET['btn-search'])) {
        $search = filter_input(INPUT_GET, 'search');
        $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");

        $sql = "SELECT * FROM player
                WHERE name = :search OR zipcode = :search OR birthdate = :search";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':search' => $search
        ]);
        $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <h2>Liste des utilisateurs correspondants</h2>

    <form method="get">
        <input type="text" name="name"/>
        <input type="text" name="zipcode"/>
        <input type="submit" name="btn-filter"/>
    </form>

    <?php
        if (isset($result)) {
            echo "<table class='table table-striped'>";

            foreach ($result as $player) {
                echo "
            <tr>
                <td>".$player['id']."</td>
                <td>".$player['name']."</td>
                <td>".$player['birthdate']."</td>
                <td>".$player['zipcode']."</td>
            </tr>";
            }

            echo "</table>";
        }
    ?>

    <h2>Liste des utilisateurs correspondants (en recherchant dans tous les champs de la bdd)</h2>

    <form method="get">
        <input type="text" name="search"/>
        <input type="submit" name="btn-search"/>
    </form>



    <?php
        if (isset($result2)) {
            echo "<table>";

            foreach ($result2 as $player) {
                echo "
            <tr>
                <td>".$player['id']."</td>
                <td>".$player['name']."</td>
                <td>".$player['birthdate']."</td>
                <td>".$player['zipcode']."</td>
                <td>".$player['points']."</td>
            </tr>";
            }

            echo "</table>";
        }
    ?>
    </body>
    </html>