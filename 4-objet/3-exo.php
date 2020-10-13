<?php
/*
 * 1- Modélisez la classe Player
 * en vous basant sur la table correspondante en bdd
 * (id, points, zipcode, email, etc.)
 *
 *  - Propriété
 *  - Constructeur (avec un paramètre par propriété)
 *  - getter/setter
 *
 * 2- Dans un script, instanciez un Player
 * Puis modifiez son nom
 * Puis affichez son nom
 */

require 'model/Player.php';

// instanciation
$player = new Player();

// modifier son nom
$name = "toto";
$player->setName($name);

// afficher son nom
echo $player->getName();