<?php


class PlayerManager
{
    public function findAll() {
        $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");

        // sélection de tous les joueurs
        $sql = "SELECT P.id as 'id_player', P.name as 'name_player', P.birthdate, P.email, P.points, 
                P.team_id, P.weapon_id, P.zipcode,
                T.id as 'id_team', T.name as 'name_team', T.level
                 FROM player P LEFT JOIN team T ON P.team_id = T.id";
        $stmt = $pdo->query($sql);

        $tabPlayers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $teamsTemp = [];

        // créer un tableau de Player
        $players = [];
        foreach ($tabPlayers as $tab) {
            $player = new Player();
            $player->setId($tab['id_player']);
            $player->setName($tab['name_player']);
            $player->setBirthdate($tab['birthdate']);
            $player->setEmail($tab['email']);
            $player->setPoints($tab['points']);
            $player->setTeamId($tab['team_id']);
            $player->setWeaponId($tab['weapon_id']);
            $player->setZipcode($tab['zipcode']);

            if ($tab['id_team'] != null) {
                // si l'équipe a déjà été créée en mémoire on la reprend au lieu
                // d'instancier un nouvel objet
                if (array_key_exists($tab['id_team'], $teamsTemp)) {
                   $team = $teamsTemp[$tab['id_team']];
               }
               else {
                   // on crée une nouvelle team pour chaque player
                   // attention l'équipe rouge par exemple peut exister plusieurs fois en mémoire
                   $team = new Team();
                   $team->setId($tab['id_team']);
                   $team->setName($tab['name_team']);
                   $team->setLevel($tab['level']);

                   $teamsTemp[$team->getId()] = $team;
               }

                // affecter l'équipe au joueur
                $player->setTeam($team);
            }

            $players[] = $player;
        }

        return $players;
    }

    public function insert($player) {
        $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
        // 2 - requete sql
        $query = "INSERT INTO player (name, birthdate, email, points, zipcode, team_id)
                  VALUES (:name, :birthdate, :email, :points, :zc, :team)";
        // 3 - preparation
        $stmt = $pdo->prepare($query);

        // 4 - formatage de certaines valeurs
        // on crée la date en format sql
        if ($player->getBirthdate() != "") {
            $dateTemp = explode("/", $player->getBirthdate());
            $birthdate = $dateTemp[2]."-".$dateTemp[1]."-".$dateTemp[0];
            $player->setBirthdate($birthdate);
        }
        else {
            // la date n'est pas obligatoire en bdd, il faut passer null dans la requête
            // et pas chaine vide car chaine vide n'est pas correct pour un champ date
            $player->setBirthdate(null);
        }

        $result = $stmt->execute([
            ':name' => $player->getName(),
            ':birthdate' => $player->getBirthdate(),
            ':email' => $player->getEmail(),
            ':points' => $player->getPoints(),
            ':zc' => $player->getZipcode(),
            ':team' => ($player->getTeam() != null) ? $player->getTeam()->getId() : null,
        ]);

        return $result;
    }

    public function find($idPlayer) {
        // connexion à la bdd
        $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");

        // selectionner le joueur à éditer
        $sql = "SELECT * FROM player WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        try {
            $result = $stmt->execute([
                ':id' => $idPlayer
            ]);
            // fetch renvoie le premier resultat (ici le premier joueur de la requete)
            $tabPlayer = $stmt->fetch(PDO::FETCH_ASSOC);

            // création d'un joueur à partir des informations de la bdd
            if ($tabPlayer != false) {
                $player = new Player();
                $player->setId($tabPlayer['id']);
                $player->setName($tabPlayer['name']);
                $player->setBirthdate($tabPlayer['birthdate']);
                $player->setPoints($tabPlayer['points']);
                $player->setZipcode($tabPlayer['zipcode']);
                $player->setEmail($tabPlayer['email']);
                $player->setTeamId($tabPlayer['team_id']);
                return $player;
            }

            return false;
        }
        catch(Exception $e) {
            return false;
        }
    }

    public function update($player) {
        $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
        // 2 - requete sql
        $query = "UPDATE player SET name=:name, birthdate=:birthdate, email=:email,
                      points=:points, zipcode=:zc, team_id=:team WHERE id = :id";
        // 3 - preparation
        $stmt = $pdo->prepare($query);

        // 4 - formatage de certaines valeurs
        // on crée la date en format sql
        if ($player->getBirthdate() != "") {
            $dateTemp = explode("/", $player->getBirthdate());
            $birthdateSQL = $dateTemp[2]."-".$dateTemp[1]."-".$dateTemp[0];
            $player->setBirthdate($birthdateSQL);
        }
        else {
            // la date n'est pas obligatoire en bdd, il faut passer null dans la requête
            // et pas chaine vide car chaine vide n'est pas correct pour un champ date
            $player->setBirthdate(null);
        }

        $editOK = $stmt->execute([
            ':name' => $player->getName(),
            ':birthdate' => $player->getBirthdate(),
            ':email' => $player->getEmail(),
            ':points' => $player->getPoints(),
            ':zc' => $player->getZipcode(),
            ':team' => ($player->getTeamId() != "") ? $player->getTeamId() : null,
            ':id' => $player->getId(),
        ]);

        return $editOK;
    }

    public function delete($id) {
        // connexion à la bdd
        $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
        // requête sql de suppression
        $sql = "DELETE FROM player WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();

        return $result;
    }
}

