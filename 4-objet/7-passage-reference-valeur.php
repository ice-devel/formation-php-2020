<?php
  /*
   * Passage par référence / valeur
   *
   * Passer par valeur: c'est copier la valeur originale pour la mettre
   * dans la variable de la fonction
   *
   * Le passage par valeur, c'est le comportement par défaut
   * des valeurs scalaires : string, int, bool, array
   *
   *
   * Passer un paramètre par référence, c'est copier la référence mémoire
   * et non pas la valeur : ce qui veut qui si vous modifiez la valeur
   * dans la fonction, la valeur originale est également modifiée
   *
   * Le passage par référence c'est le comportement par défaut des objets
   */

function sayUpperHello($name) {
    // ici la variable originale $var n'a pas été modifiée
    $name = strtoupper($name);
    echo $name;
}

// script principal
$var = "antonio";
sayUpperHello($var);
// $var n'a pas été modifié, il est toujours en minuscule
echo $var;

include ('model/Player.php');
$batman = new Player();
$batman->setName("batman");

function sayHelloToPlayer($p) {
    $upperName = strtoupper($p->getName());

    // $p est un objet, il a été passé par référence
    // donc modifier $p revient à modifier la variable $batman
    $p->setName($upperName);

    echo $p->getName();
}

echo "<pre>";
// à cette ligne, batman est en minuscule
sayHelloToPlayer($batman);
// à cet ligne batman est en majuscule
var_dump($batman);

/*
 * Autre exemple
 */
function displayPlus10Days($datetime) {
    // la variable $now a été passée par référence
    // donc elle est modifiée parce qu'on modifie $datetime
    $datetime->add(new DateInterval("P10D"));
    echo $datetime->format('d/m/Y')."<br>";
}

$now = new DateTime();
displayPlus10Days($now);
// $now n'est plus la date actuelle
echo $now->format("d/m/Y")."<br>";


/*
 * Il se passe la même chose pour les affectations
 */
$a = 5;
// la valeur de a est copiée dans b
$b = $a;
// mais si on modifie b, on ne modifie pas a
$b = 10;
echo $a."<br>";

$superman = new Player(1, "Superman", "2010-01-01");
// on ne copie pas la valeur, on donne la même référence à deux variables
$captain = $superman;
// en modifiant $captain, on modifie aussi $superman
$captain->setName("captain");

echo $superman->getName()."<br>";

/*
 * Comparaison
 */
$a = 5;
$b = "5";

if ($a == $b) {
    // vrai
}

if ($a === $b) {
    // faux
}

$batman = new Player();
$batman->setName("jean");
$superman = new Player();
$superman->setName("jean");

if ($batman == $superman) {
    // vrai
    // $batman et $superman sont Player
    // et leurs propriétés ont les mêmes valeurs
}

if ($batman === $superman) {
    // faux : on teste si la référence (l'id) de deux objets est la même
}

/*
 *  Paramètre de fonction : on peut changer le comportement par défaut
 * Types scalaires : on met juste le "&" devant le nom du param
 */

function loadNumbers(&$numbers) {
    for ($i=0;$i<10;$i++) {
        // en modifiant $numbers, on modifie la variable $tab
        $numbers[] = $i;
    }
}

$tab = [];
// on passe $tab par référence car on a mis le "&" devant le paramètre de
// de la fonction
loadNumbers($tab);
var_dump($tab);

$cesar = new Player();
$cesar->setId(1);
$cesar->setName("César");

function modifyPlayerByValue($player) {
    $player->setId(10);
}

// cloner un objet, c'est créer une nouvelle référence en mémoire
// tout en reprenant les mêmes valeurs pour les propriétés scalaires
// les objets contenus dans l'objet continueront d'avoir la même référence
// dans les deux objets
$clonedCesar = clone $cesar;
modifyPlayerByValue($clonedCesar);











