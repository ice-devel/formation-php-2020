<?php
   /*
    * Les fonctions
    * Une fonction est une suite d'instructions/un traitement qu'on va centraliser
    * afin de pouvoir la/le réutiliser sans avoir à la réécrire.
    * On va pour cela lui donner un nom.
    * Une fonction est donc composé de :
    *   - une signature (function, nom de la fonction, paramètres)
    *   - un corps (les instructions à réaliser)
    *
    * Une fonction peut avoir des paramètres d'entrées (obligatoires/facultatifs)
    * et une valeur de retour
    */
function add($nb1, $nb2) {
    $sum = $nb1 + $nb2;
    return $sum; // un return stope la fonction et retourne la valeur
}

// utilisation d'une fonction :
// affectation
$result = add(10, 15);
$result++;
echo $result."<br>";

// affichage
echo add(9, 4)."<br>";

// test
if (add(4, 2) > 5) {
    echo "4 + 2 est supérieur à 5<br>";
}

// add(3); fatal error : 2 paramètres obligatoires mais un seul passé

// attention entre double guillemet on peut afficher la valeur d'une variable
// sans avoir à concaténer : on peut rester dans la chaine de caractère
// alors qu'entre simple guillemet, les variables ne sont pas interprétées, il faut donc
// concaténer pour afficher la valeur d'une variable
$number = 34;
echo "La variable number a la valeur $number <br>";
echo 'La variable number a la valeur $number <br>';

/*
 * fonction sans valeur de retour : procédure
 */
function sayHello() {
    echo "Coucou mon chéwie<br>";
}

sayHello();
sayHello();

/*
 * Paramètres facultatifs :
 * un paramètre facultatif est un paramètre qui a une valeur par défaut
 * dans la signature
 * Les paramètres facultatifs sont toujours après les paramètres obligatoires
 */
function my_in_array($array, $search, $strict=false) {
    $isFounded = false;
    foreach ($array as $value) {
        // comparaison stricte
        if ($strict == true) {
            if ($value === $search) {
                $isFounded = true;
            }
        }
        // comparaison normale
        else {
            if ($value == $search) {
                $isFounded = true;
            }
        }

    }

    return $isFounded;
}


$tab = [4,5,6];
if (my_in_array($tab, 3) == true) {
}

if (my_in_array($tab, "4", false) == true) {
    echo "1. La valeur 4 se trouve dans le tab";
}

if (my_in_array($tab, "4", true) == true) {
    echo "2. La chaine 4 se trouve dans le tab";
}