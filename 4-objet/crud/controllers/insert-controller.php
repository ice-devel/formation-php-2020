<?php
    // récupérer toutes les équipes pour pouvoir les afficher dans le formulaire
    // (pour le choix de l'équipe)
    $teamManager = new TeamManager();
    $teams = $teamManager->findAll();

    // formulaire soumis ?
    if (isset($_POST['btn-add'])) {
        // récupération
        $playerService = new PlayerService();
        $player = $playerService->handleRequest();

        // vérifications
        $errors = $playerService->isValid($player, $teams);

        // 5 - enregistrement en bdd
        if (empty($errors)) {
            $playerManager = new PlayerManager();
            $result = $playerManager->insert($player);
        }
    }