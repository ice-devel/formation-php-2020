<?php
    // les tableaux
    // ce sont des variables qui contiennent plusieurs valeurs
    // accessibles
    // - soit grâce à un indice (qui commence à 0)
    // - soit grâce à une clé (une chaine de caractère)

    /*
     * déclarer en tableau
     */
    $numericTab = array();
    $numericTab = [];

    /*
     * déclarer un tableau en y insérant de suite des valeurs
     */
    $numericTab = [10, 23, 55, "toto"];

    echo "<pre>";
    var_dump($numericTab);
    echo "</pre>";

    /* ajouter un élément dans un tableau */
    // ça :
    array_push($numericTab, "zorro");
    // ou ça :
    $numericTab[] = "France";

    echo "<pre>";
    var_dump($numericTab);
    echo "</pre>";

    /* accéder/modifier à un élément en particulier */
    echo $numericTab[0]; // affiche le premier élément

    $numericTab[1] = "23 bis"; // modifie le deuxième élément

    echo $numericTab[99]; // attention (notice)
    $numericTab[150] = "coucou";
    // ATTENTION, on n'était qu'à l'indice 5 et on mets qqch à l'indice 150
    // ça marche mais c'est chelou nan ?

    echo "<pre>";
    var_dump($numericTab);
    echo "</pre>";

    /*
     * Supprimer un élément
     */
    unset($numericTab[150]);
    unset($numericTab[0]); // attention quand on supprime un élément de cette manière
    // on ne reclasse pas les indices : le 0 a disparou et on commence à 1

    echo "<pre>";
    var_dump($numericTab);
    echo "</pre>";

    /*
     * Parcourir un tableau
     */
    for ($i=0; $i < count($numericTab);$i++) {
        echo $numericTab[$i]."<br>";
    }

    /**
     * Les tableaux associatifs : on n'utilise plus des indices mais des clés
     **/
    // déclaration
    $associativeTab = [];
    $associativeTab["name"] = "toto";
    $associativeTab["zipcode"] = "59000";

    // déclaration avec valeurs initiales

    $associativeTab = [
        "name" => "toto",
        "zipcode" => "59000",
        "ville" => "Lille"
    ];

    // parcourir avec un foreach en récupérant uniquement les valeurs
    foreach ($associativeTab as $value) {
        echo $value."<br>";
    }

    // en récupérant également les clés
    foreach ($associativeTab as $key => $value) {
        echo $key." : ".$value."<br>";
    }

    // accéder/modifier un élément
    echo $associativeTab["name"];
    $associativeTab["zipcode"] = "59300";

    // supprimer une clé
    unset($associativeTab["zipcode"]);

    /**
     * Exemple de fonctions natives PHP sur les tableaux
     * - in_array
     * - array_key_exists
     * - array_search
     */

    // Chercher si une valeur se trouve dans un tableau: in_array
    $tabCities = ['Lille', 'Paris', 'Arras', 'Valenciennes'];
    $city = "Monaco";
    if (in_array($city, $tabCities) == true) {
        echo $city ." se trouve dans le tableau<br>";
    }
    else {
        echo $city ." ne se trouve pas dans le tableau<br>";
    }

    // chercher si une clé existe dans un tableau
    $user = ['name' => 'toto', 'zipcode' => '59000'];
    if (array_key_exists('city', $user)) {
        echo " la clé city se trouve dans le tableau<br>";
    }
    else {
        echo " la clé city ne se trouve pas dans le tableau<br>";
    }

    // chercher si une valeur existe dans un tableau et si oui
    // récupérer la clé (ou l'indice) où elle se trouve
    $firstnames = ['rachid', 'callaghan', 'kevin'];
    $position = array_search('kevin', $firstnames);
    if ($position !== false) {
        echo 'Kevin se trouve dans le tab de prénoms et se trouve à la position '.$position;
    }

    // https://www.php.net/manual/fr/book.array.php

    // compter le nombre de fois où Ben apparait dans le tableau
    $firstnames = array("Kyle","Ben","Sue","Phil","Ben","Mary","Sue","Ben");
    $counts = array_count_values($firstnames);
    echo $counts['Ben'];

    echo "<pre>";
    var_dump($counts);
    echo "</pre>";

