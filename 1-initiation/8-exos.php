<?php
    /**
     * exos : Pour ces exercices, vous n'avez accès à aucune fonction
     * native de php
     *
     * Exo 1
     * Déclarez un tableau, initialisez-le avec 5 valeurs
     * Puis écrirez le script qui affiche combien de fois
     * la valeur "toto" se trouve dans ce tableau

     * Exo 2 : Déclarez un tableau, et initialisez-le avec 5 entiers
     * Puis écrivez le script qui affiche la moyenne de ces entiers
     *
     * Exo 3 : Déclarez un tableau, et initialisez-le avec 5 entiers
     * Puis écrivez le script qui affiche la valeur la plus petite
     * de ce tableau
     *
     * Exo 4 : Initialisez une variable de type chaine
     * avec la valeur que vous souhaitée,
     * puis écrivez le script qui dit si oui ou non cette chaine est
     * un palindrome. Vous pouvez utilisez les fonctions PHP (si vous voulez)
     */

    // exo 1 - for
    $countToto = 0;
    $firstnames = ['toto', 'fab', 'calaghan', 'toto', 'biloute'];
    for ($i=0;$i<count($firstnames);$i=$i+1) {
        $prenom = $firstnames[$i];
        if ($prenom == "toto") {
            $countToto = $countToto + 1;
        }
    }

    echo $countToto."<br>";

    // exo 1 - foreach
    $countToto = 0;
    $firstnames = ['toto', 'fab', 'calaghan', 'toto', 'biloute'];
    foreach ($firstnames as $prenom) {
        if ($prenom == "toto") {
            $countToto++;
        }
    }

    // exo 2
    $integers = [];
    $integers[] = 3;
    $integers[] = 5;
    $integers[] = 9;

    $sum = 0;
    foreach ($integers as $val) {
        $sum = $sum + $val;
    }

    $nb = count($integers);
    if ($nb > 0) {
        $avg = $sum / $nb;
    }

    // exo 3
    $values = [3,4,6,2,3,1];
    $min = $values[0];
    foreach ($values as $value) {
        if ($value < $min) {
            $min = $value;
        }
    }

    echo $min;

    // exo 4
    $chaine = "bonjour";
    if (strrev($chaine) == $chaine) {
        echo "palindrome";
    }
    else {
        echo "papalindrome";
    }






