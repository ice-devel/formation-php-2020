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
    */

include "class/Character.php";
include "class/Wizard.php";
include "class/WhiteWizard.php";

$character = new Character("Daniel");
$wizard = new Wizard("Gandalf", 100);
$whiteWizard = new WhiteWizard("Gandalf le blanc", 100);

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