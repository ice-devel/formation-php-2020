<?php
/**
 * Exemple d'utilisation d'objet
 *
 */
include('entity/User.php');

$yesterday = new DateTime();
$yesterday->sub(new DateInterval('P1D'));


// instanciation d'un user
$user = new User();
$user2 = new User(null, null, "Toto");
$user3 = new User(2, $yesterday, "Superman", "superman@gmail.fr", true);

echo "<pre>";
var_dump($user);
var_dump($user2);
var_dump($user3);
echo "</pre>";

echo $user3->getName();

// impossible car la propriété est privée
//$user3->name = "Batman";
// il faut donc passer par le setter :
$user3->setName("Batman");

echo "<pre>";
var_dump($user3);
echo "</pre>";

//$user2->name = "biloute";
$user2->setName("biloute");

if ($user2->getName() == "gérard") {

}



