<?php
    /**
     * SELECT
     */
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");

    // sélection de tous les joueurs
    $sql = "SELECT * FROM player";
    $stmt = $pdo->query($sql);
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // récupérer les joueurs d'une équipe
    $sql = "SELECT * FROM player WHERE team_id = 1";
    $stmt = $pdo->query($sql);
    $team1Players = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // récupération des joueurs d'une équipe dynamique
    // formulaire validé ?
    if (isset($_GET['team'])) {
        // récupération des valeurs
        $team = filter_input(INPUT_GET, 'team');

        // vérification du format
        $errors = [];
        if (empty($team)) {
            $errors['team'] = "Veuillez saisir une équipe";
        }

        // on peut bien entendu faire d'autres vérifications, comme regarder
        // si c'est un entier qui a été envoyé

        if (count($errors) == 0) {
            // requete select
            // on injecte surtout pas quelquechose qui vient de l'utilisateur dans une requête sql
            // $sql = "SELECT * FROM player WHERE team_id = ".$team;
            // $stmt = $pdo->query($sql);

            // ici on est protégé des injections : on utilise des paramètres PDO
            // grâce aux ":"
            $sql = "SELECT * FROM player WHERE team_id = :team";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":team", $team);
            $stmt->execute();

            /*
             * La même chose mais en passant les paramètres PDO dans la méthode executeS
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':team' => $team
            ]);
            */

            $dynamicTeamPlayers = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            echo
            "<tr>
                <td>".$player['id']."</td>
                <td>".$player['name']."</td>
                <td>".$player['birthdate']."</td>
            </tr>";

        }
    ?>
    </table>

    <h2>Joueur de l'équipe 1</h2>
    <table>
        <?php
            foreach ($team1Players as $player) {
                echo
                    "<tr>
                <td>".$player['id']."</td>
                <td>".$player['name']."</td>
                <td>".$player['birthdate']."</td>
            </tr>";

            }
        ?>
    </table>

    <h2>Joueur d'une équipe</h2>
    <form method="get" action="">
        <input type="text" name="team" />
        <input type="submit" />
    </form>

    <?php
        if (isset($errors) && count($errors) > 0) {
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
        if (isset($dynamicTeamPlayers)) {
            echo "Equipe choisie :".$team;
            echo "<table>";
            foreach ($dynamicTeamPlayers as $player) {
                echo
                    "<tr>
                        <td>" . $player['id'] . "</td>
                        <td>" . $player['name'] . "</td>
                        <td>" . $player['birthdate'] . "</td>
                        <td>" . $player['team_id'] . "</td>
                    </tr>";
            }
            echo  "</table>";
        }
    ?>

</body>
</html>
