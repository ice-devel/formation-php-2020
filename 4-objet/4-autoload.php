<?php
    function loadClass($className) {
        $filename = "model/".$className.".php";

        if (file_exists($filename)) {
            require $filename;
        }
    }

    function loadEntity($className) {
        $filename = "entity/".$className.".php";

        if (file_exists($filename)) {
            require $filename;
        }
    }

    // ces fonctions seront automatiquement appelées
    // lors qu'un objet sera instancié, si la classe n'est pas encore incluse
    spl_autoload_register('loadClass');
    spl_autoload_register('loadEntity');

    // ici le fichier Player.php n'a pas été inclus
    // donc avant de planter, PHP va exécuter les fonctions d'autoload
    // que l'on a enregistrées avec spl_autoload_register

    $player = new Player();
    $player->setName("bibou");
    echo $player->getName();

    $user = new User();
    $user->setName("User1");
    $user->getName();