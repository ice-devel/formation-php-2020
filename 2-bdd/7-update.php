<?php
    /**
    *  UPDATE
    */
    // récupérer l'id du joueur qu'on veut éditer : on a passé son id dans l'URL
    $id = filter_input(INPUT_GET, 'id');

    // générer un code 404 si l'id n'est pas passé dans l'url
    if ($id == null) {
        header("HTTP/1.0 404 Not Found");
        die("Cette page n'existe pas");
    }

    // connexion à la bdd
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
    // selectionner le joueur à éditer
    $sql = "SELECT * FROM player WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':id' => $id
    ]);

    // si la requête plante, on peut envoyer au navigateur le code 503
    if ($result == false) {
        http_response_code(503);
        echo "Désolé erreur 503 (service indisponible), maintenance en cours";
        exit;
    }

    // fetch renvoie le premier resultat (ici le premier joueur de la requete)
    $player = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($player == false) {
        // générer un code 404 si l'id ne correspondait à aucun joueur en bdd
        header("HTTP/1.0 404 Not Found");
        die("Cette page n'existe pas");
    }

    // REFORMATER LA DATE sql VERS fr
    if ($player['birthdate'] != "") {
        $dateTemp = explode("-", $player['birthdate']);
        $player['birthdate'] = $dateTemp[2]."/".$dateTemp[1]."/".$dateTemp[0];
    }

    // récupérer toutes les équipes pour pouvoir les afficher dans le formulaire
    // (pour le choix de l'équipe)
    $sql = "SELECT * FROM team";
    $stmt = $pdo->query($sql);
    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // formulaire soumis ?
    if (isset($_POST['btn-edit'])) {
        // récupération
        $name = filter_input(INPUT_POST, 'name');
        $birthdate = filter_input(INPUT_POST, 'birthdate');
        $email = filter_input(INPUT_POST, 'email');
        $points = filter_input(INPUT_POST, 'points');
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $team = filter_input(INPUT_POST, 'team');

        // vérifications
        $errors = [];
        if ($name == "" || strlen($name) < 2 || strlen($name) > 40) {
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

        // modifier le tableau player avec les nouvelles informations
        $player['name'] = $name;
        $player['birthdate'] = $birthdate;
        $player['email'] = $email;
        $player['points'] = $points;
        $player['zipcode'] = $zipcode;
        $player['team_id'] = $team;

        // 5 - enregistrement en bdd
        if (empty($errors)) {
            // 1 - connexion bdd (on l'a déjà faite au dessus)
            // $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
            // 2 - requete sql
            $query = "UPDATE player SET name=:name, birthdate=:birthdate, email=:email,
                      points=:points, zipcode=:zc, team_id=:team WHERE id = :id";
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

            $editOK = $stmt->execute([
                ':name' => $name,
                ':birthdate' => $birthdate,
                ':email' => $email,
                ':points' => $points,
                ':zc' => $zipcode,
                ':team' => ($team != "") ? $team : null,
                ':id' => $id,
            ]);

            if ($editOK == true) {
                // le player a été bien modifié, redirection vers une page
                header('Location: 6-list.php?updated-player='.$id);
                exit;
            }
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
    <h1>Edition d'un joueur</h1>

    <?php
        if (isset($errors)) {
            foreach ($errors as $error) {
                echo $error."<br>";
            }
        }

        if (isset($editOK)) {
            if ($editOK == true) {
                echo "Player bien modifié";
            }
            else {
                echo "Erreur serveur inconnue, veuillez contacter votre administrateur";
            }
        }
    ?>

    <form method="post">
        <input type="text" name="name" placeholder="Nom" value="<?php echo $player['name']; ?>"/><br>
        <input type="text" name="birthdate" placeholder="Date" value="<?php echo $player['birthdate']; ?>"/><br>
        <input type="email" name="email" placeholder="Email" value="<?php echo $player['email']; ?>"/><br>
        <input type="number" name="points" placeholder="Points" value="<?php echo $player['points']; ?>"/><br>
        <input type="text" name="zipcode" placeholder="CP" value="<?php echo $player['zipcode']; ?>"/><br>
        <select name="team">
            <option></option>
            <?php
                /*
                 * $t est l'équipe qu'on est entrain d'afficher
                 */
                foreach ($teams as $t) {
                    // si l'équipe entrain d'être affichée est l'équipe du joueur,
                    // on va la présélectionner dans la liste
                    if ($t['id'] == $player['team_id']) {
                        $isSelected = "selected";
                    }
                    else {
                        $isSelected = "";
                    }

                    echo "<option value='".$t['id']."' ".$isSelected.">".$t['name']."</option>";
                }
            ?>
        </select>

        <input type="submit" name="btn-edit"/>
    </form>
</body>
</html>