<?php
    class PlayerService
    {
        /*
         * Récupération des informations envoyées depuis le formulaire
         * Retourne un objet Player
         */
        public function handleRequest($player=null) {
            $name = filter_input(INPUT_POST, 'name');
            $birthdate = filter_input(INPUT_POST, 'birthdate');
            $email = filter_input(INPUT_POST, 'email');
            $points = filter_input(INPUT_POST, 'points');
            $zipcode = filter_input(INPUT_POST, 'zipcode');
            $teamId = filter_input(INPUT_POST, 'team');

            // mettre à jour un joueur
            if ($player != null) {
                $player->setName($name);
                $player->setBirthdate($birthdate);
                $player->setEmail($email);
                $player->setPoints($points);
                $player->setZipcode($zipcode);

                // on ne travaille l'id de la team, mais un objet Team
                $player->setTeamId($teamId);

                // aller chercher dans le teamManager
                // (on les a stocké dans la propriété statique $teams)
                $teams = TeamManager::getAllTeams();

                // on cherche l'équipe choisie dans le formulaire
                foreach ($teams as $t) {
                    if ($t->getId() == $teamId) {
                        // on associe l'équipe au joueur
                        $player->setTeam($t);
                    }
                }


                return $player;
            }
            else {
                $coucou = new Player(null, $name, $birthdate, $email, $points, $zipcode, $teamId);
                return $coucou;
            }
        }

        /*
         * Retoune un tableau d'erreurs (si vide == pas d'erreur)
         */
        public function isValid($player, $teams=null) {
            $errors = [];
            if ($player->getName() == "" || mb_strlen($player->getName()) < 2 || mb_strlen($player->getName()) > 40) {
                $errors[] = "Votre nom pas correct reremplir svp";
            }

            if ($player->getBirthdate() != "" && !preg_match("#\d{2}/\d{2}/\d{4}#", $player->getBirthdate())) {
                $errors[] = "date naissance pas bonne gné";
            }

            if ($player->getEmail() == "" || filter_var($player->getEmail(), FILTER_VALIDATE_EMAIL) == false) {
                $errors[] = "email pas valide";
            }

            if ($player->getPoints() == "" || !preg_match("/\d+/", $player->getPoints()) || $player->getPoints() < 0 || $player->getPoints() > 255) {
                $errors[] = "points pas valides";
            }

            if ($player->getZipcode() == "" || !preg_match("/\d(\d|A|B)\d{3}/", $player->getZipcode())) {
                $errors[] = "cp invalide";
            }

            // on a choisi une équipe ?
            /*
            if ($player->getTeam() != null) {
                // est-ce que l'équipe en base ?
                $teamExist = false;
                foreach ($teams as $t) {
                    if ($t->getId() == $player->getTeam()->getId()) {
                        $teamExist = true;
                    }
                }
                if ($teamExist == false) {
                    $errors[] = "la team n'existe pas";
                }
            }
            */

            return $errors;
        }
    }