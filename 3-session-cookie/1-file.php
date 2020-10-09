<?php
    // ouvrir un fichier en mode écriture : WRITE
    // en plaçant le pointeur au début et en supprimant le contenu
    $monFichier = fopen("test.txt", 'w');
    fwrite($monFichier, "1;Toto".PHP_EOL);
    fclose($monFichier);

    // ouvrir un fichier en mode écriture : APPEND
    // en plaçant le pointeur à la fin du fichier
    // et donc en gardant les données déjà présentes
    $monFichier = fopen("test.txt", 'a');
    fwrite($monFichier, "2;Gérard");
    fclose($monFichier);

    // ouvrir un fichier en mode lecture : READ
    $monFichier = fopen("test.txt", 'r');
    $content = fgets($monFichier);
    while ($content != false) {
        $user = explode(';', $content);
        $content = fgets($monFichier);
    }

    // le tout en une fonction
    // file_put_contents
    // file_get_contents

    // écrire
    // en écrasant le contenu
    file_put_contents('test2.txt', "bonjour");
    // pour ajouter en gardant le contenu actuel
    file_put_contents('test2.txt', "bonjour", FILE_APPEND);

    // lire
    $content = file_get_contents('test.txt');

