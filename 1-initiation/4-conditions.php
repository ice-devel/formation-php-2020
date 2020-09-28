<?php
    // les conditions : structures conditionnelles
    // le if et le switch
    // qui permettent de comparer des valeurs : ce sont les conditions
    // on peut assembler plusieurs conditions
    //      le AND : &&
    //      le OR : ||
    // On peut inverser une condition avec : !

    // le IF
    $age = 18;
    $majorite = 18;
    if ($age >= $majorite) {
        echo "Bienvenue VIP";
    }

    // le ELSE : instructions à réaliser si la condition est fausse
    if ($age >= $majorite) {
        echo "Bienvenue VIP";
    }
    else {
        echo "Veuillez sortir maintenant";
    }

    if (5 == 5) {
        // on rentre
    }

    if (5 != 5) {
        // on rentre pas
    }

    // conditions multiples
    if (5 == 5 && 3 < 4 && 9 > 10) {
        // on rentre pas car le && attend que toutes les
        // sous conditions soient vraies , or 9 < 10 est faux
    }

    if (5 == 5 && 3 < 4 || 9 > 10) {
        // on rentre ici grâce au OR
        // même si 9 > 10 est faux
    }

    // attention aux priorités : d'abord les ET, puis les OU
    // on peut utiliser les parenthèses pour prioriser
    if (5 == 5 && (3 < 4 || 9 > 10)) {
        // on rentre ici aussi, même si les conditions n'ont pas
        // été évaluées de la même manière qu'au dessus
    }

    // le elseif
    if ($age > 18) {
        // ok pour ton permis
    }
    elseif ($age > 15) {
        // alors bonhomme
    }
    elseif ($age > 10) {
        // hey petit
    }
    else {
        // i veu un bonbon
    }

    // le SELON : on teste une valeur (pas de AND pas de OR)
    $age = 25;
    switch ($age) {
        case 5:
            echo "T'es encore un petit bébé";
            break;
        case 18:
            echo "Alors ready pour le permis voiture électrique";
            break;
        case 30:
        case 31:
            echo "t'es finalement devenu responsable";
            break;
        default:
            echo "Vous n'avez ni 5, ni 18, ni 30 ans.";
            break;
    }

    // équivalent avec un elseif
    if ($age == 5) {
        echo "T'es encore un petit bébé";
    }
    elseif ($age == 18) {
        echo "Alors ready pour le permis voiture électrique";
    }

    // conversion de type automatique
    $chaine = "bonjour";
    if ($chaine >= 5) {
        // pas de warning, mais on rentre pas
    }

    if ($chaine >= 0) {
        // on rentre car la conversion de la chaine donne 0
    }

    /*
     * Comparaison stricte
     * opérateur de comparaison : == et !=
     * Pour comparer des valeurs
     *
     * opérateur de comparaison stricte : === et !==
     * pour comparer des valeurs et les types
     */

    if (1 == 1) {
        // on rentre
    }

    if (1 != 1) {
        // on rentre pas
    }

    if (1 == "1") {
        // on rentre
    }

    if (1 == true) {
        // on rentre, en php le 1 équivaut au vrai
    }

    if (0 == true) {
        // on rentre pas
    }

    if (1 === "1") {
        // on rentre pas, car les valeurs sont les mêmes
        // mais les types sont différents
    }

    if (1 !== "1") {
        // on rentre car même si les valeurs sont équivalentes
        // les types sont différents
    }
    
    if (1 !== true) {
        // on rentre
    }
?>