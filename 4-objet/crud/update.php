<?php
    /**
     *  UPDATE POO
     */
    include('autoload.php');

    // récupérer l'id du joueur qu'on veut éditer : on a passé son id dans l'URL
    $id = filter_input(INPUT_GET, 'id');

    // générer un code 404 si l'id n'est pas passé dans l'url
    if ($id == null) {
        header("HTTP/1.0 404 Not Found");
        die("Cette page n'existe pas");
    }

    // connexion à la bdd
    $playerManager = new PlayerManager();
    $player = $playerManager->find($id);
    $birthdateToDisplay = $player->getBirthdateFR();

    if ($player == false) {
        // générer un code 404 si l'id ne correspondait à aucun joueur en bdd
        header("HTTP/1.0 404 Not Found");
        die("Cette page n'existe pas");
    }

    // récupérer toutes les équipes pour pouvoir les afficher dans le formulaire
    // (pour le choix de l'équipe)
    $teamManager = new TeamManager();
    $teams = $teamManager->findAll();

    // 1 - formulaire soumis ?
    if (isset($_POST['btn-edit'])) {
        // 2- récupération
       $playerService = new PlayerService();
       $player = $playerService->handleRequest($player);
       $birthdateToDisplay = $player->getBirthdate();

       $errors = $playerService->isValid($player, $teams);

        // 5 - enregistrement en bdd
        if (empty($errors)) {
           $editOK = $playerManager->update($player);

            if ($editOK == true) {
                // le player a été bien modifié, redirection vers une page
                header('Location: select.php?updated-player='.$id);
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
        echo "Erreur serveur inconnue, veuillez contacter votre administrateur";
    }
?>

<form method="post">
    <input type="text" name="name" placeholder="Nom" value="<?php echo $player->getName(); ?>"/><br>
    <input type="text" name="birthdate" placeholder="Date" value="<?php echo $birthdateToDisplay; ?>"/><br>
    <input type="email" name="email" placeholder="Email" value="<?php echo $player->getEmail(); ?>"/><br>
    <input type="number" name="points" placeholder="Points" value="<?php echo $player->getPoints(); ?>"/><br>
    <input type="text" name="zipcode" placeholder="CP" value="<?php echo $player->getZipcode() ?>"/><br>
    <select name="team">
        <option></option>
        <?php
            /*
             * $t est l'équipe qu'on est entrain d'afficher
             */
            foreach ($teams as $t) {
                $isSelected = $t->getId() == $player->getTeamId() ? "selected" : "";
                echo "<option value='".$t->getId()."' ".$isSelected.">".$t->getName()."</option>";
            }
        ?>
    </select>

    <input type="submit" name="btn-edit"/>
</form>
</body>
</html>
