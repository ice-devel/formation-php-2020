<?php
    /**
     * INSERT POO
     */
    include('autoload.php');

    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");

    // récupérer toutes les équipes pour pouvoir les afficher dans le formulaire
    // (pour le choix de l'équipe)
    $teamManager = new TeamManager();
    $teams = $teamManager->findAll();

    // formulaire soumis ?
    if (isset($_POST['btn-add'])) {
        // récupération
        $playerService = new PlayerService();
        $player = $playerService->handleRequest();

        // vérifications
        $errors = $playerService->isValid($player, $teams);

        // 5 - enregistrement en bdd
        if (empty($errors)) {
            $playerManager = new PlayerManager();
            $result = $playerManager->insert($player);
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
    <input type="text" name="name" placeholder="Nom" value="<?php if (isset($player)) echo $player->getName(); ?>"/><br>
    <input type="text" name="birthdate" placeholder="Date" value="<?php if (isset($player)) echo $player->getBirthdate(); ?>"/><br>
    <input type="email" name="email" placeholder="Email" value="<?php if (isset($player)) echo $player->getEmail(); ?>"/><br>
    <input type="number" name="points" placeholder="Points" value="<?php if (isset($player)) echo $player->getPoints(); ?>"/><br>
    <input type="text" name="zipcode" placeholder="CP" value="<?php if (isset($player)) echo $player->getZipcode(); ?>"/><br>
    <select name="team">
        <option></option>
        <?php
            foreach ($teams as $t) {
                $isSelected = isset($player) && $player->getTeamId() == $t->getId() ? "selected" : "";
                echo "<option value='".$t->getId()."' ".$isSelected.">".$t->getName()."</option>";
            }
        ?>
    </select>

    <input type="submit" name="btn-add"/>
</form>
</body>
</html>
