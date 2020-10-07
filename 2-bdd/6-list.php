<?php
    /**
    *  LIST
    */
    // récupération de tous les joueurs
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
    $sql = "SELECT * FROM player;";
    $stmt = $pdo->query($sql);
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h1>Liste des joueurs</h1>

    <?php
        // si on vient de la page 7-update.php suite à une redirection
        // (mise à jour d'un joueur effective), on affiche un message
        if (isset($_GET['updated-player'])) {
            echo "<p>
                    Player bien modifié
                </p>";
        }
    ?>


    <table>
        <?php
            foreach ($players as $player) {
                echo "
                <tr>
                    <td>".$player['id']."</td>
                    <td>".$player['name']."</td>
                    <td>".$player['birthdate']."</td>
                    <td><a href='7-update.php?id=".$player['id']."'>Editer</a></td>
                    <td>Supprimer</td>
                </tr>";
            }
        ?>
    </table>

</body>
</html>
