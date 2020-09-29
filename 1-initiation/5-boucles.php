<?php
    // les boucles : structures itératives
    // for, while, do while
    // Répéter une ou plusieurs instructions un certain nombre de fois
    // for : nombre d'itérations déterminé
    // while : quand on ne connait pas le nb d'itération à l'avance
    // do while : while mais avec au moins une itération
    // foreach : for particulier

    echo "Tour 1";
    echo "Tour 2";
    echo "Tour 3";
    echo "Tour 4";
    echo "Tour 5";

    // for
    // 3 paramètres (initialisation; condition d'arret; incrementation/le pas)
    $somme = 0;
    for ($i=0; $i < 5; $i = $i + 1) {
        echo "Tour ".($i + 1);
        $somme = $somme + $i + 1;
    }

    // while
    $somme = rand(0, 100);

    while ($somme < 100) {
        $randomNumber = rand(0, 25); // rand : générer un nb aléatoire compris entre
        $somme = $somme + $randomNumber;
    }

    // do while
    $somme = 1;

    do {
        $randomNumber = rand(0, 25); // rand : générer un nb aléatoire compris entre
        $somme = $somme + $randomNumber;
    } while ($somme < 100);


    /*
     *
     */

?>