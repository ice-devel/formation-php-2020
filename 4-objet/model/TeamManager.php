<?php
    class TeamManager
    {
        static private $teams;

        static public function getAllTeams() {
            return TeamManager::$teams;
        }

        public function findAll() {
            if (TeamManager::$teams != null) {
                return TeamManager::$teams;
            }

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

            TeamManager::$teams = $teams;

            return $teams;
        }
        
    }