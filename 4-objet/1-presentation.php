<?php
/**
 * POO : programmation orientée objet
 * On structure son code grâce des classes d'objets
 *  1- Modélisation des classes
 *  2- Instanciation d'un objet (avec le mot-clé new)
 *
 *
 * Pourqui la POO ?
 *  - Meilleure structure de code : centralisation de ce qui se rapporte au même concept dans une classe
 *  - Meilleure évolutivité / maintenance
 *  - Meilleure compréhension par les autres développeurs :
 *    on respecte tous et toutes les mêmes conventions et principes
 *
 *
 *  Dans une classe :
 * - propriété
 * - constructeur
 * - getter/setter
 * - méthode
 *
 * Grand principe de la POO : le principe d'encapsulation
 * qui permet de centraliser les accès (lecture/écriture) aux propriétés
 * pour s'assurer : des types de données, des valeurs, etc.
 */


/*
 * En procédural, on ferait :
 */
$name1 = "Batman";
$strength1 = 60;
$health1 = 100;

$name2 = "Superman";
$strength2 = 90;
$health2 = 100;

function hit($health, $strength) {
    $health = $health - $strength;
    return $health;
}

$health2 = hit($health2, $strength1);
$health1 = hit($health1, $strength2);

/**
 * Version objet
 */
include('entity/Player.php');

// instanciation d'un joueur (création d'un joueur en mémoire)
// quand on fait un "new", le constructeur est appelé
$batman = new Player();
$batman->name = "Batman";
$batman->strength = 60;
$batman->health = 100;

$superman = new Player("Superman", 100, 90);


/*
 * Ca c'est caca :
function hit($health, $strength) {
    $health = $health - $strength;
    return $health;
}

$player2->health = hit($player2->health, $player->strength);
*/

/*
 * Intermédiaire mais caca quand même
$newLife = $player2->hit($player->health, $player->strength);
$player->health = $newLife;
*/

echo "<pre>";
var_dump($batman);
var_dump($superman);
echo "</pre>";

$superman->hit($batman);
$batman->hit($superman);

echo "<pre>";
var_dump($batman);
var_dump($superman);
echo "</pre>";


/*
 * sans commentaire ni var_dump :
 */
$batman = new Player("Batman", 60, 100);
$superman = new Player("Superman", 100, 90);
$superman->hit($batman);
$batman->hit($superman);
