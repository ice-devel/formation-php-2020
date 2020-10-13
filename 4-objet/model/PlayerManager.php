<?php


    class PlayerManager
    {
        public function findAll() {
            $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");

            // sélection de tous les joueurs
            $sql = "SELECT * FROM player";
            $stmt = $pdo->query($sql);
            $tabPlayers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // créer un tableau de Player
            $players = [];
            foreach ($tabPlayers as $tab) {
                $player = new Player();
                $player->setId($tab['id']);
                $player->setName($tab['name']);
                $player->setBirthdate($tab['birthdate']);
                $player->setEmail($tab['email']);
                $player->setPoints($tab['points']);
                $player->setTeamId($tab['team_id']);
                $player->setWeaponId($tab['weapon_id']);
                $player->setZipcode($tab['zipcode']);

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
                ':team' => ($player->getTeamId() != "") ? $player->getTeamId() : null,
            ]);

            return $result;
        }
    }