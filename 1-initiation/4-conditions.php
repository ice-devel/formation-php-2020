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

    $chaine = "bonjour";
    $search = "o";
    // strpos est une fonction qui permet de chercher une chaine dans une chaine
    // la position est retournée si elle est trouvée, false est renvoyé si la chaine n'est pas trouvé
    if (strpos($chaine, $search) != false) {
        echo "o se trouve dans bonjour";
    }

    $search = "r";
    if (strpos($chaine, $search) != false) {
        echo "r se trouve dans bonjour";
    }

    $search = "z";
    if (strpos($chaine, $search) != false) {
        // on rentre pas
        // echo "z se trouve dans bonjour";
    }

    $search = "b";
    if (strpos($chaine, $search) != false) {
        // 0 != false
        // on va pas rentrer alors qu'on devrait
        // car 0 est équivalent à false
    }
    // correction :
    if (strpos($chaine, $search) !== false) {
        // on rentre :)
    }

// Précisions sur les booléens
    if (true) {

    }

    $isAllowed = true;

    if ($isAllowed == true) {
        echo "Vous êtes VIP";
    }

    if ($isAllowed) {
        echo "VIP";
    }

    if ($isAllowed == false) {
        echo "Section interdite";
    }

    if (!$isAllowed) {
        echo "Section interdite";
    }

    // V1
    $age = 20;
    if ($age >= 18) {
        echo "Vous êtes majeur";
    }
    else {
        echo "Vous êtes mineur";
    }

    // V2
    $age = 20;
    if ($age >= 18) {
        $message = "majeur";
    }
    else {
        $message = "mineur";
    }

    echo "Vous êtes ".$message;

    // V3 : ternaire : possible quand la seule instruction se trouvant dans le if, ainsi
    // que dans le else est une affectation
    // une ternaire sert à affecter une valeur à une variable
    $message = $age >= 18 ? "majeur" : "mineur";
    echo "Vous êtes ".$message;

    $age = 17;
    // V1
    if ($age >= 18) {
        $isAllowed = true;
    }
    else {
        $isAllowed = false;
    }
    // autorisé à voir ce film ?
    if ($isAllowed) {}
    // autorisé à jouer à ce jeu ?
    if ($isAllowed) {}

    // V2
    $isAllowed = $age >= 18 ? true : false;

    // V3
    $isAllowed = $age >= 18;


?>