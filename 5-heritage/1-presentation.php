<?php
    /*
     * Héritage :
     * Classe A : parent
     * Classe B : enfant - possède toutes les propriétés et les méthodes du parents

    Portée des propriétés et méthodes :
    public : accessible partout (classe, ses enfants et ailleurs)
    private : accessible uniquement dans la classe
    protected : accessible dans la classe et ses enfants

    L'héritage c'est :
    Si B hérite de A, alors on peut dire que B est un A, mais pas que A est un B

    Classe finale : classe dont on ne peut hériter
    Classe abstraite : classe qu'on ne peut pas instancier

    Méthode abstraite : doit être rédéfinie obligatoirement dans les enfants
    (et ne peux se trouver quand dans une classe abstraite)
    Méthode finale : fonction ne pouvant être redéfinie dans les enfants

    Interface :
    Ne contient que des signatures : les classes qui implémentent ces interfaces
    doivent définir les méthodes correspondantes

    Héritage : une classe ne peut hériter que d'une seule classe, mais plusieurs enfants peuvent de la même classe
    Interface : une classe peut implémenter plusieurs interfaces, et une interface peut être implémentée par plusieurs
    extends UneSeuleClass, implements interface1, interface2
    */

include "class/AbstractCharacter.php";
include "class/Character.php";
include "class/Wizard.php";
include "class/WhiteWizard.php";


$character = new Character("Daniel");
$wizard = new Wizard("Gandalf", 100);
$whiteWizard = new WhiteWizard("Gandalf le blanc", 100);

// impossible d'instancier une classe abstraite
// $abstractCharacter = new AbstractCharacter();

$wizard->sayHello();
$wizard->sleep();
$whiteWizard->healEverybody();

$characters = [];
$characters[] = $character;
$characters[] = $wizard;
$characters[] = $whiteWizard;
$characters[] = "Batman";

echo "<pre>";
var_dump($characters);

/*
 * operator instanceof : tester si une variable est une instance d'une certaine calsse
 * elle renvoie vrai aussi si l'instance est d'une classe qui hérite de la classe testée
 */
foreach ($characters as $char) {
    // est-ce que $char est une instance de
    // Character ou d'une de ses classes enfant
    if ($char instanceof Character) {
        // sleep est public dans character donc on sait qu'on peut l'appeler
        // pour tous les personnages sans exception
        $char->sleep();
        $char->walk();
    }
    if ($char instanceof Wizard) {
        // sayHello était private dans Character, sauf que Wizard l'a redéfini
        // en public
        $char->sayHello();
    }
    if ($char instanceof WhiteWizard) {
        $char->healEverybody();
    }
}

