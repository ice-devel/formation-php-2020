<?php
    /**
     * SELECT
     **/
    include('autoload.php');

    $playerManager = new PlayerManager();
    $players = $playerManager->findAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table td {
            border:1px solid;
        }
    </style>
</head>
<body>
<h2>Tous les joueurs</h2>
<table>
    <?php
        foreach ($players as $player) {
            $teamName = $player->getTeam() != null ? $player->getTeam()->getName() : "";
            $teamLevel = $player->getTeam() != null ? $player->getTeam()->getLevel() : "";
            echo
                "<tr>
                <td>".$player->getId()."</td>
                <td>".$player->getName()."</td>
                <td>".$player->getBirthdate()."</td>
                <td>".$teamName."</td>
                <td>".$teamLevel."</td>
                <td><a href='update.php?id=".$player->getId()."'>Modifier</a></td>
                <td><a href='delete.php?id=".$player->getId()."'>Supprimer</a></td>
            </tr>";

        }
    ?>
</table>
</body>
</html>
