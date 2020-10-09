<?php
    /**
    * INSERT EXO
     * 1 - Créer le formulaire HTML correspondant à l'insertion d'un player sauf weapon_id
     * 2 - Lorsque le formulaire est soumis,
     * récupérer les valeurs pour les enregistrer dans la bdd (table player)
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
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");

    // récupérer toutes les équipes pour pouvoir les afficher dans le formulaire
    // (pour le choix de l'équipe)
    $sql = "SELECT * FROM team";
    $stmt = $pdo->query($sql);
    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // formulaire soumis ?
    if (isset($_POST['btn-add'])) {
        // récupération
        $name = filter_input(INPUT_POST, 'name');
        $birthdate = filter_input(INPUT_POST, 'birthdate');
        $email = filter_input(INPUT_POST, 'email');
        $points = filter_input(INPUT_POST, 'points');
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $team = filter_input(INPUT_POST, 'team');

        // vérifications
        $errors = [];
        if ($name == "" || mb_strlen($name) < 2 || mb_strlen($name) > 40) {
            $errors[] = "Votre nom pas correct reremplir svp";
        }

        if ($birthdate != "" && !preg_match("#\d{2}/\d{2}/\d{4}#", $birthdate)) {
            $errors[] = "date naissance pas bonne gné";
        }

        if ($email == "" || filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $errors[] = "email pas valide";
        }

        if ($points == "" || !preg_match("/\d+/", $points) || $points < 0 || $points > 255) {
            $errors[] = "points pas valides";
        }

        if ($zipcode == "" || !preg_match("/\d(\d|A|B)\d{3}/", $zipcode)) {
            $errors[] = "cp invalide";
        }

        // on a choisi une équipe ?
        if ($team != "") {
            // est-ce que l'équipe en base ?
            $teamExist = false;
            foreach ($teams as $t) {
                if ($t['id'] == $team) {
                    $teamExist = true;
                }
            }
            if ($teamExist == false) {
                $errors[] = "la team n'existe pas";
            }
        }

        // 5 - enregistrement en bdd
        if (empty($errors)) {
            // 1 - connexion bdd (on l'a déjà faite au dessus)
            // $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
            // 2 - requete sql
            $query = "INSERT INTO player (name, birthdate, email, points, zipcode, team_id)
                      VALUES (:name, :birthdate, :email, :points, :zc, :team)";
            // 3 - preparation
            $stmt = $pdo->prepare($query);

            // 4 - formatage de certaines valeurs
            // on crée la date en format sql
            if ($birthdate != "") {
                $dateTemp = explode("/", $birthdate);
                $birthdate = $dateTemp[2]."-".$dateTemp[1]."-".$dateTemp[0];
            }
            else {
                // la date n'est pas obligatoire en bdd, il faut passer null dans la requête
                // et pas chaine vide car chaine vide n'est pas correct pour un champ date
                $birthdate = null;
            }

            $result = $stmt->execute([
                ':name' => $name,
                ':birthdate' => $birthdate,
                ':email' => $email,
                ':points' => $points,
                ':zc' => $zipcode,
                ':team' => ($team != "") ? $team : null,
            ]);

            // penser à rediriger
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
</head>
<body>
    <h1>Création d'un joueur</h1>

    <?php
        if (isset($errors)) {
            foreach ($errors as $error) {
                echo $error."<br>";
            }
        }

        if (isset($result)) {
            if ($result == true) {
                echo "Player bien enregistré";
            }
            else {
                echo "Erreur serveur inconnue, veuillez contacter votre administrateur";
            }
        }
    ?>

    <form method="post">
        <input type="text" name="name" placeholder="Nom" value="<?php if (isset($name)) echo $name; ?>"/><br>
        <input type="text" name="birthdate" placeholder="Date" value="<?php if (isset($birthdate)) echo $birthdate; ?>"/><br>
        <input type="email" name="email" placeholder="Email" value="<?php if (isset($email)) echo $email; ?>"/><br>
        <input type="number" name="points" placeholder="Points" value="<?php if (isset($points)) echo $points; ?>"/><br>
        <input type="text" name="zipcode" placeholder="CP" value="<?php if (isset($zipcode)) echo $zipcode; ?>"/><br>
        <select name="team">
            <option></option>
            <?php
                foreach ($teams as $t) {
                    /*
                    $isSelected = "";
                    if (isset($team) && $team == $t['id']) {
                        $isSelected = "selected";
                    }
                    */
                    $isSelected = isset($team) && $team == $t['id'] ? "selected" : "";
                    echo "<option value='".$t['id']."' ".$isSelected.">".$t['name']."</option>";
                }
            ?>
        </select>

        <input type="submit" name="btn-add"/>
    </form>
</body>
</html>
