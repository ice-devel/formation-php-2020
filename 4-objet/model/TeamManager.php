<?php
    class TeamManager
    {
        public function findAll() {
            $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");

            // sélection de tous les joueurs
            $sql = "SELECT * FROM team";
            $stmt = $pdo->query($sql);
            $tabTeams = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // créer un tableau de Player
            $teams = [];
            foreach ($tabTeams as $tab) {
                $team = new Team();
                $team->setId($tab['id']);
                $team->setName($tab['name']);
                $team->setLevel($tab['level']);

                $teams[] = $team;
            }

            return $teams;
        }
        
    }