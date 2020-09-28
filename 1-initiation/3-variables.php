<?php
    // Les variables
    // php est un langage interprété et non typé (faiblement typé)

    // les types primitifs - on ne type pas les variables, mais leur valeur
    // est interprétée à l'exécution et elles ont donc un type à ce moment-là
    $str = "Je suis une chaine de caractères";
    $entier = 5;
    $decimal = 42.5;
    $booleen = true;

    echo $str."<br>";
    echo $entier."<br>";
    echo $decimal."<br>";
    echo $booleen."<br>"; // true : 1, false : ""

    var_dump($str);
    echo "<br>";
    var_dump($entier);
    echo "<br>";
    var_dump($decimal);
    echo "<br>";
    var_dump($booleen);
    echo "<br>";

    // les constantes (sans le $): on déclare une constante avec la fonction define
    define("MA_CONSTANTE", 50);
    echo MA_CONSTANTE."<br>";
    var_dump(MA_CONSTANTE);
    echo "<br>";

    // ou avec le mot-clé const depuis php5.3
    const CONSTANTE2 = "test";
    echo CONSTANTE2."<br>";

    var_dump(CONSTANTE2);
    echo "<br>";

    $variableSansTypeNiValeur = null;

    // opérateur de concaténation : le point
    $chaine = "Bonjour";
    $chaine2 = "tout";
    $chaine3 = "le monde";
    $chaineBonjour = $chaine." ".$chaine2." ".$chaine3;

    // $chaineBonjour : string = Bonjour tout le monde
    var_dump($chaineBonjour);
    echo "<br>";

    // opérateur arithmétique
    $somme = 5 + 10; // donne 15
    echo $somme;

    $difference = 20 - 4;
    $quotient = 30 / 5;
    $produit = 4 * 3;

    // conversion automatique des types
    $difference = "125" - 3.2; // ok : 122,8
    $difference = "coucou" - 3; // warning : coucou transformé en 0
    var_dump($difference);

    $difference = "coucou12" - 3; // warning : coucou12 transformé en 0 : -3
    $difference = "12coucou" - 3; // warning : 12coucou transformé en 12 : 9

    // le modulo : le reste
    $modulo = 20 % 3; // : 3 * 6 = 18 / 20 - 18 = 2

    // les priorités
    $calcul = 5 * 3 + 6 - 2 / 2; // 15 + 6 - 1 = 20
    $calcul = 5 * (3 + 6) - 2 / 2; // 5 *  9 - 1 = 44
?>