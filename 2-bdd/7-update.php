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

    // récupérer toutes les équipes pour pouvoir les afficher dans le formulaire
    // (pour le choix de l'équipe)
    $sql = "SELECT * FROM team";
    $stmt = $pdo->query($sql);
    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    $isSelected = isset($team) && $team == $t['id'] ? "selected" : "";
                    echo "<option value='".$t['id']."' ".$isSelected.">".$t['name']."</option>";
                }
            ?>
        </select>

        <input type="submit" name="btn-add"/>
    </form>
</body>
</html>
