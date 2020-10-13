<?php
    class PlayerService
    {
        /*
         * Récupération des informations envoyées depuis le formulaire
         * Retourne un objet Player
         */
        public function handleRequest() {
            $name = filter_input(INPUT_POST, 'name');
            $birthdate = filter_input(INPUT_POST, 'birthdate');
            $email = filter_input(INPUT_POST, 'email');
            $points = filter_input(INPUT_POST, 'points');
            $zipcode = filter_input(INPUT_POST, 'zipcode');
            $teamId = filter_input(INPUT_POST, 'team');

            $coucou = new Player(null, $name, $birthdate, $email, $points, $zipcode, $teamId);

            return $coucou;
        }

        /*
         * Retoune un tableau d'erreurs (si vide == pas d'erreur)
         */
        public function isValid($player, $teams) {
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
            if ($player->getTeamId() != "") {
                // est-ce que l'équipe en base ?
                $teamExist = false;
                foreach ($teams as $t) {
                    if ($t->getId() == $player->getTeamId()) {
                        $teamExist = true;
                    }
                }
                if ($teamExist == false) {
                    $errors[] = "la team n'existe pas";
                }
            }

            return $errors;
        }
    }