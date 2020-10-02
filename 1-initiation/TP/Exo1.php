<?php
/*
 * Exercice 1 :

a) Déclarer et initialiser :
- une variable de type chaine de caractères avec la valeur 1
- une variable de type entier avec la valeur 1
- une variable de type boolean avec la valeur vrai

b) comparer ces variables :
- la chaine avec l'entier, en utilisant l'opérateur qui fera que php les considère équivalentes
- la chaine avec l'entier, en utilisant l'opérateur qui fera que php les considère différentes

c) - stocker ces trois variables dans une variable de type tableau
utiliser une boucle pour parcourir ce tableau
utiliser la fonction var_dump pour afficher à l'écran chaque entrée
 */

$string = "1";
$integer = 1;
$boolean = true;

if ($string == $integer) {

}

if ($string !== $integer) {

}

$tab = [];
$tab[] = $string;
$tab[] = $integer;
$tab[] = $boolean;

for ($index=0;$index < count($tab);$index++) {
    var_dump($tab[$index]);
}
